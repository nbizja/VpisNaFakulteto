<?php

namespace App\Models\Repositories;


use App\Models\Drzava;
use App\Models\Drzavljanstvo;
use App\Models\Element;
use App\Models\KoncanaSrednjaSola;
use App\Models\Obcina;
use App\Models\Posta;
use App\Models\Prijava;
use App\Models\SrednjaSola;
use App\Models\StudijskiProgram;
use App\Models\Uporabnik;
use App\Models\VisokosolskiZavod;

class VpisRepository
{
    public function drzave()
    {
        return Drzava::all();
    }

    public function drzavljanstva()
    {
        return Drzavljanstvo::all();
    }

    public function obcine()
    {
        return Obcina::all();
    }

    public function poste()
    {
        return Posta::all();
    }

    public function predmetiSplosneMature()
    {
        return Element::where('id', 'like', 'M%')->get();
    }

    public function srednjesolskaIzobrazba(Uporabnik $uporabnik)
    {
        return [
            'naciniZakljucka' => KoncanaSrednjaSola::all(),
            'srednjeSole' => SrednjaSola::all()->sortBy('ime'),
            'splosniPredmeti' => $this->predmetiSplosneMature(),
            'drzave' => Drzava::all(),
            'srednjesolskaIzobrazba' => $uporabnik->srednjesolskaIzobrazba()->with('nacinZakljucka')->first()
        ];
    }

    public function prijavaZaStudij(Uporabnik $kandidat)
    {
        $prijave = $kandidat->prijave()->with('studijskiProgram')->get()->sortBy('zelja');

        $izbraniZavodi = array_pad($prijave->map(function($prijava) {
           return $prijava->studijskiProgram->id_zavoda;
        })->toArray(), 3, 0);
        $izbraniProgrami = array_pad($prijave->map(function($prijava){
           return $prijava->id_studijskega_programa;
        })->toArray(), 3, 0);

        return [
            'visokosolskiZavodi' => VisokosolskiZavod::with('obcina')->get()->sortBy('ime'),
            'studijskiProgrami' => StudijskiProgram::all(),
            'izbraniZavodi' => $izbraniZavodi,
            'izbraniProgrami' => $izbraniProgrami
        ];
    }
    
    public function pregledPrijave(Uporabnik $uporabnik)
    {
        return [
            'osebniPodatki' => $uporabnik->osebniPodatki()->first(),
            'stalnoPrebivalisce' => $uporabnik->prebivalisce()->with('obcina', 'posta', 'drzava')->first(),
            'naslovZaPosiljanje' => $uporabnik->naslovZaPosiljanje()->with('obcina', 'posta', 'drzava')->first(),
            'srednjesolskaIzobrazba' => $uporabnik->srednjesolskaIzobrazba()->with('nacinZakljucka', 'srednjaSola', 'drzava')->first(),
            'prijave' => $uporabnik->prijave()->with('studijskiProgram', 'studijskiProgram.visokosolskiZavod')->get()->sortBy('zelja'),
            'datum_oddaje_prijave' => $uporabnik->datum_oddaje_prijave
        ];
    }
}