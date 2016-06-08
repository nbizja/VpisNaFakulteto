<?php

namespace App\Models\Logic;


use App\Models\StudijskiProgram;
use Illuminate\Support\Collection;

class Razvrscanje
{
    const STEVILO_ITERACIJ = 50;
    /**
     * @var Collection  [id_kandidata => 1 | 2 | 3 ]  X pomeni, da na X željo ni sprejet.
     */
    private $obravnava;

    private $programi;

    /**
     * @param StudijskiProgram[] $programi
     */
    public function razvrsti($programi)
    {
        $this->programi = $programi;
        $this->obravnava = new Collection();

        //Vstavimo 1. želje (Že vstavljeno v queryiju)
        //Inicializiramo spremenljivko obravnava
        $this->inicializacija();
        //Razvrscanje
        $this->obravnava();
        //Preverimo, da se komu ni zgodila krivica
        $this->preveriPravilnostObravnave();

        //Zapišemo v bazo
        $this->shraniRezultate();

    }

    private function inicializacija()
    {
        $this->programi->each(function(&$program) {

            //Sortiramo prijave po točkah
            $program->prijave = $program->prijave->sortByDesc('tocke');

            $this->obravnava = $this->obravnava->merge(
                $program->prijave
                    ->keyBy(function($prijava){
                        return 'K'. $prijava->id_kandidata;
                    })
                    ->transform(function($val, $id) {
                        return 1; //Obravnavamo prvo željo
                    })
            );
        });
    }

    /**
     * @param StudijskiProgram[] $programi
     */
    private function obravnava()
    {
        for($i = 0; $i < self::STEVILO_ITERACIJ; $i++) {
            $this->programi->each(function(&$program) {

                //Filtriramo samo obravnavane prijave
                $obravnavanePrijave = $program->prijave
                    ->filter(function($prijava) {
                        return $prijava->zelja == $this->obravnava->get('K'. $prijava->id_kandidata)
                            && $prijava->tocke > 0;
                    })
                    ->values(); //Reset array keys

                $program->stevilo_sprejetih = $obravnavanePrijave->take($program->stevilo_vpisnih_mest)->count();


                $program->omejitev_vpisa = 0;

                if ($program->stevilo_sprejetih == $program->stevilo_vpisnih_mest) {
                    //Zadnja sprejeta prijava.
                    $zadnjaSprejetaPrijava = $obravnavanePrijave->get($program->stevilo_sprejetih - 1);

                    $program->omejitev_vpisa = $zadnjaSprejetaPrijava->tocke;

                    //Preverimo, če imajo naslednje zavrnjene prijave enako število točk kot zadnja sprejeta prijava
                    $obravnavanePrijave
                        ->slice($program->stevilo_vpisnih_mest)
                        ->each(function($prijava) use(&$program) {
                            if ($prijava->tocke < $program->omejitev_vpisa) {
                                return false;
                            }
                            $program->stevilo_sprejetih++;

                            return true;
                        });
                }


                //Vsem nesprejetim povečamo obvravnavano željo
                $obravnavanePrijave
                    ->slice($program->stevilo_sprejetih)
                    ->each(function($prijava) {
                        //Kandidat s trenutno zeljo ima premalo tock.
                        if ($this->obravnava->get('K'. $prijava->id_kandidata) < 3) {
                            $this->obravnava['K'. $prijava->id_kandidata] = $this->obravnava['K'. $prijava->id_kandidata] + 1;
                        }
                    });
                /*if ($program->id == 838) {
                    dd($this->obravnava);
                }*/


            });
        }

        return true;
    }
    
    private function preveriPravilnostObravnave()
    {
        
    }
    
    private function shraniRezultate()
    {
        $this->programi->each(function($program) {
            $program->prijave
                ->filter(function($prijava) {
                    return $prijava->zelja == $this->obravnava->get('K'. $prijava->id_kandidata);
                })
                ->take($program->stevilo_sprejetih)
                ->each(function($prijava) {
                   $prijava->sprejet = 1;
                   $prijava->save();
               });

            $program->prijave
                ->filter(function($prijava) {
                    return $prijava->zelja == $this->obravnava->get('K'. $prijava->id_kandidata);
                })
                ->slice($program->stevilo_sprejetih)
                ->each(function($prijava) {
                    $prijava->sprejet = 0;
                    $prijava->save();
                });
        });

        return true;
    }

}