<?php

namespace App\Http\Controllers;


use App\Models\Repositories\RazvrscanjeRepository;

class RazvrscanjeController extends Controller
{

    private $razvrscanjeRepo;

    public function __construct(RazvrscanjeRepository $razvrscanjeRepository)
    {
        $this->razvrscanjeRepo = $razvrscanjeRepository;
    }

    public function zapisiTocke()
    {
        $kandidati = $this->razvrscanjeRepo->vrniVsePrijavljeneKandidate();
        
        $kandidati->filter(function($kandidat) {
            
        });

        foreach ($kandidati as $kandidat) {

            if (!$kandidat->poklicnaMatura->isEmpty()) {
                $tipMature = 1;
                $matura = $kandidat->poklicnaMatura->first();

            } else if (!$kandidat->matura->isEmpty()) {
                $tipMature = 0;
                $matura = $kandidat->matura->first();

            } else {
                
            };


            $predmetiS = $kandidat->predmetiPoklicna()->with('predmet')->get();
            $predmetiP = $kandidat->predmetiSplosna()->with('predmet')->get();
            $predmeti = $predmetiS->merge($predmetiP);

            $rezultat = array(false, false, false, 0, 0, 0);
            if ($matura != null) {
                if ($matura->opravil == 1) {
                    $rezultat = $this->preveriZelje($tipMature, $predmeti, $matura, $kandidat);
                } else {
                    $rezultat = array(false, false, false, 0, 0, 0);
                }
            }

            $tocke = $this->izracunajTocke($rezultat, $predmeti, $matura, $tipMature, $kandidat);
        }

    }
}