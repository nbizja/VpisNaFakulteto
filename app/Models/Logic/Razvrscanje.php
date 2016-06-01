<?php

namespace App\Models\Logic;


use App\Models\Razvrstitev;
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
    public function razvrstiSlovence($programi)
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

    }

    private function inicializacija()
    {
        $this->programi->each(function($program) {

            //Sortiramo prijave po točkah
            $program->prijave->sortBy('tocke');

            $this->obravnava->merge(
                $program->prijave
                    ->pluck('id_kandidata')
                    ->flip()
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
                        return $prijava->zelja == $this->obravnava[$prijava->id_kandidata];
                    });

                $program->stevilo_sprejetih = $obravnavanePrijave->take($program->stevilo_vpisnih_mest - 1)->count();

                //Zadnja sprejeta prijava.
                $zadnjaSprejetaPrijava = $obravnavanePrijave->get($program->stevilo_vpisnih_mest - 1);
                if (!is_null($zadnjaSprejetaPrijava)) {
                    $program->omejitev_vpisa = $zadnjaSprejetaPrijava->tocke;

                    //Preverimo, če imajo naslednje zavrnjene prijave enako število točk kot zadnja sprejeta prijava
                    $obravnavanePrijave
                        ->slice($program->stevilo_vpisnih_mest - 1)
                        ->each(function($prijava) use($program) {
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
                        if ($this->obravnava[$prijava->id_kandidata] < 3) {
                            $this->obravnava[$prijava->id_kandidata]++;
                        }
                    });
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
               ->take($program->stevilo_sprejetih)
               ->map(function($priava) {
                   return Razvrstitev::create([
                       ''
                   ])
               });
        });
    }

}