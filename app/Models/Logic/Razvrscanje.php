<?php

namespace App\Models\Logic;


use App\Models\StudijskiProgram;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Razvrscanje
{
    const STEVILO_ITERACIJ = 50;

    private $obravnava;

    private $steviloZelj;

    private $programi;

    /**
     * @param StudijskiProgram[] $programi
     */
    public function razvrsti($programi, $tujci = false)
    {
        $this->programi = $programi;

        /**********************************
                   SLOVENCI
         *********************************/
        $this->obravnava = [];
        $this->steviloZelj = [];

        //Vstavimo 1. želje (Že vstavljeno v queryiju)
        //Inicializiramo spremenljivko obravnava
        $this->inicializacija($tujci);

        //Razvrscanje
        $this->obravnava($tujci);

        //Zapišemo v bazo
        $this->shraniRezultate($tujci);

        //Preverimo, da se komu ni zgodila krivica
        $nepravilneObravnave = $this->preveriPravilnostObravnave();
        //Popravimo nepravilne obravnave
        //dd($nepravilneObravnave);
        //$this->popraviNepravilneObravnave($nepravilneObravnave);


    }

    private function inicializacija($tujci = false)
    {
        $this->programi->each(function(&$program) use($tujci) {

            //Sortiramo prijave po točkah
            $program->prijave = $program->prijave
                ->filter(function($prijava) use($tujci) {
                    return $tujci ?
                        $prijava->kandidat->osebniPodatki->first()->id_drzavljanstva != 2 :
                        $prijava->kandidat->osebniPodatki->first()->id_drzavljanstva == 2;
                })
                ->sortByDesc('tocke');

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
                if ($prijava->zelja >= $trenutnaZelja) {
                    $this->steviloZelj['K'. $prijava->id_kandidata] = $prijava->zelja;
                }
            });

        });
    }

    /**
     * @param bool $tujci
     */
    private function obravnava($tujci = false)
    {
        for($i = 0; $i < self::STEVILO_ITERACIJ; $i++) {
            $this->programi->each(function(&$program) use($tujci) {

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
                

                if (!$obravnavanePrijave->isEmpty()) {

                    $steviloSprejetih = $tujci ? 'stevilo_sprejetih_tujci' : 'stevilo_sprejetih';
                    $omejitev = $tujci ? 'omejitev_vpisa_tujci' : 'omejitev_vpisa';
                    $steviloVpisnihMest = $tujci ? 'stevilo_vpisnih_mest_tujci' : 'stevilo_vpisnih_mest';

                    $program->$steviloSprejetih = $obravnavanePrijave->take($program->$steviloVpisnihMest)->count();


                    $program->$omejitev = 0;

                    if ($program->$steviloSprejetih == $program->$steviloVpisnihMest) {
                        //Zadnja sprejeta prijava.
                        $zadnjaSprejetaPrijava = $obravnavanePrijave->get($program->$steviloVpisnihMest - 1);
                        $program->$omejitev = $zadnjaSprejetaPrijava->tocke;

                        //Preverimo, če imajo naslednje zavrnjene prijave enako število točk kot zadnja sprejeta prijava
                        $obravnavanePrijave
                            ->slice($program->$steviloVpisnihMest)
                            ->each(function ($prijava) use (&$program, $omejitev, $steviloSprejetih) {
                                if ($prijava->tocke >= $program->$omejitev) {
                                    $program->$steviloSprejetih++;
                                }
                            });
                    }

                    //Vsem nesprejetim povečamo obvravnavano željo
                    $obravnavanePrijave
                        ->slice($program->$steviloSprejetih)
                        ->each(function ($prijava) {
                            //Kandidat s trenutno zeljo ima premalo tock.
                            $novaObravnava = $this->obravnava['K' . $prijava->id_kandidata] + 1;

                            $this->obravnava['K' . $prijava->id_kandidata] =
                                $novaObravnava <= $this->steviloZelj['K' . $prijava->id_kandidata]
                                    ? $novaObravnava : 1;

                        });
                    DB::table('studijski_program')
                        ->where('id', $program->id)
                        ->update([
                            $omejitev => $program->$omejitev,
                            $steviloSprejetih => $program->$steviloSprejetih
                        ]);
                }
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
    
    private function shraniRezultate($tujci = false)
    {
        $steviloSprejetih = $tujci ? 'stevilo_sprejetih_tujci' : 'stevilo_sprejetih';
        $omejitev = $tujci ? 'omejitev_vpisa_tujci' : 'omejitev_vpisa';

        $this->programi->each(function($program) use($steviloSprejetih, $omejitev, $tujci) {

            $uvrstitev = 1;
            $program->prijave
                ->filter(function($prijava) {
                    return $prijava->zelja == $this->obravnava['K'. $prijava->id_kandidata];
                })
                ->values()
                ->take($program->$steviloSprejetih)
                ->each(function($prijava) use(&$uvrstitev, $tujci) {
                    if ($tujci) {
                        $prijava->tujec = 1;
                    }
                    $prijava->sprejet = 1;
                    $prijava->uvrstitev = $uvrstitev;
                    $prijava->save();

                    $uvrstitev++;
                });

            $program->prijave
                ->filter(function($prijava) use($program, $omejitev) {
                    return $prijava->zelja != $this->obravnava['K'. $prijava->id_kandidata]
                    || $prijava->tocke == 0
                    || $prijava->tocke < $program->$omejitev;
                })
                ->each(function($prijava) use($tujci) {
                    if ($tujci) {
                        $prijava->tujec = 1;
                    }
                    $prijava->sprejet = 0;
                    $prijava->save();
                });
        });

        return true;
    }

}