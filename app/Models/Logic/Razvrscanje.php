<?php

namespace App\Models\Logic;


use App\Models\StudijskiProgram;
use Illuminate\Support\Collection;

class Razvrscanje
{
    const STEVILO_ITERACIJ = 50;

    private $obravnava;

    private $steviloZelj;

    private $programi;

    /**
     * @param StudijskiProgram[] $programi
     */
    public function razvrsti($programi)
    {
        $this->programi = $programi;
        $this->obravnava = [];
        $this->steviloZelj = [];

        //Vstavimo 1. želje (Že vstavljeno v queryiju)
        //Inicializiramo spremenljivko obravnava
        $this->inicializacija();

        //Razvrscanje
        $this->obravnava();

        //Zapišemo v bazo
        $this->shraniRezultate();

        //Preverimo, da se komu ni zgodila krivica
        $nepravilneObravnave = $this->preveriPravilnostObravnave();
        //Popravimo nepravilne obravnave
        
        //$this->popraviNepravilneObravnave($nepravilneObravnave);


    }

    private function inicializacija()
    {
        $this->programi->each(function(&$program) {

            //Sortiramo prijave po točkah
            $program->prijave = $program->prijave->sortByDesc('tocke');

            $this->obravnava = array_merge($this->obravnava,
                $program->prijave
                    ->keyBy(function($prijava){
                        return 'K'. $prijava->id_kandidata;
                    })
                    ->transform(function($val, $id) {
                        return 1; //Obravnavamo prvo željo
                    })
                ->all()
            );

            $program->prijave->each(function($prijava) {
                $trenutnaZelja = $this->steviloZelj['K'. $prijava->id_kandidata] ?? 1;
                if ($prijava->zelja > $trenutnaZelja) {
                    $this->steviloZelj['K'. $prijava->id_kandidata] = $prijava->zelja;
                }
            });

        });
    }

    /**
     * @param StudijskiProgram[] $programi
     */
    private function obravnava()
    {
        for($i = 0; $i < self::STEVILO_ITERACIJ; $i++) {
            $this->programi->each(function(&$program) use($i) {

                //Vsem, ki ne ustrezajo pogojem (tocke == 0) povečamo obravnavano željo
                $program->prijave
                    ->filter(function($prijava) {
                        return $prijava->tocke == 0
                        && $prijava->zelja == $this->obravnava['K'. $prijava->id_kandidata];
                    })
                    ->each(function($prijava) {
                        //Kandidat s trenutno zeljo ima premalo tock.
                        $novaObravnava = $this->obravnava['K'. $prijava->id_kandidata] + 1;

                        $this->obravnava['K'. $prijava->id_kandidata] =
                            $novaObravnava <= $this->steviloZelj['K'. $prijava->id_kandidata]
                                ? $novaObravnava : 1;

                    });

                //Filtriramo samo obravnavane prijave
                $obravnavanePrijave = $program->prijave
                    ->filter(function($prijava) {
                        return $prijava->zelja == $this->obravnava['K'. $prijava->id_kandidata];
                    })
                    ->values(); //Reset array keys


                $program->stevilo_sprejetih = $obravnavanePrijave->take($program->stevilo_vpisnih_mest)->count();


                $program->omejitev_vpisa = 0;

                if ($program->stevilo_sprejetih == $program->stevilo_vpisnih_mest) {
                    //Zadnja sprejeta prijava.
                    $zadnjaSprejetaPrijava = $obravnavanePrijave->get($program->stevilo_vpisnih_mest - 1);

                    $program->omejitev_vpisa = $zadnjaSprejetaPrijava->tocke;

                    //Preverimo, če imajo naslednje zavrnjene prijave enako število točk kot zadnja sprejeta prijava
                    $obravnavanePrijave
                        ->slice($program->stevilo_vpisnih_mest)
                        ->each(function($prijava) use(&$program) {
                            if ($prijava->tocke >= $program->omejitev_vpisa) {
                                $program->stevilo_sprejetih++;
                            }
                        });
                }

                //Vsem nesprejetim povečamo obvravnavano željo
                $obravnavanePrijave
                    ->slice($program->stevilo_sprejetih)
                    ->each(function($prijava) {
                        //Kandidat s trenutno zeljo ima premalo tock.
                        $novaObravnava = $this->obravnava['K'. $prijava->id_kandidata] + 1;

                        $this->obravnava['K'. $prijava->id_kandidata] =
                            $novaObravnava <= $this->steviloZelj['K'. $prijava->id_kandidata]
                                ? $novaObravnava : 1;

                    });
            });
        }

        return true;
    }

    private function preveriPravilnostObravnave()
    {
        $neustreznePrijave = [];
        $this->programi->each(function($program) use(&$neustreznePrijave) {
            $np = $program->prijave->filter(function($prijava) use($program, &$neustreznePrijave) {
                return $prijava->zelja <= $this->obravnava['K'. $prijava->id_kandidata]
                    && $prijava->tocke >= $program->omejitev_vpisa
                    && $prijava->tocke > 0
                    && $prijava->sprejet == 0;

            })->all();

            $neustreznePrijave = array_merge($neustreznePrijave, $np);
        });

        return collect($neustreznePrijave);
    }

    private function popraviNepravilneObravnave($prijave)
    {
        $prijave->each(function($prijava) {
            $novaObravnava = ($this->obravnava['K'. $prijava->id_kandidata] + 1) % $this->steviloZelj['K'. $prijava->id_kandidata];
            $this->obravnava['K'. $prijava->id_kandidata] =$novaObravnava ? $novaObravnava : $novaObravnava + 1;
        });
    }
    
    private function shraniRezultate()
    {
        $this->programi->each(function($program) {

            $program->prijave
                ->filter(function($prijava) {
                    return $prijava->zelja == $this->obravnava['K'. $prijava->id_kandidata];
                })
                ->values()
                ->take($program->stevilo_sprejetih)
                ->each(function($prijava) {
                   $prijava->sprejet = 1;
                   $prijava->save();
                });

            $program->prijave
                ->filter(function($prijava) use($program) {
                    return $prijava->zelja != $this->obravnava['K'. $prijava->id_kandidata]
                    || $prijava->tocke == 0
                    || $prijava->tocke < $program->omejitev_vpisa;
                })
                ->each(function($prijava) {
                    $prijava->sprejet = 0;
                    $prijava->save();
                });
        });

        return true;
    }

}