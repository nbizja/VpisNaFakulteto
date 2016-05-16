<?php

namespace App\Models\Repositories;


use App\Models\Drzava;
use App\Models\Drzavljanstvo;
use App\Models\Element;
use App\Models\KoncanaSrednjaSola;
use App\Models\Obcina;
use App\Models\Posta;
use App\Models\PrijavaOsebniPodatki;
use App\Models\PrijavaPrebivalisce;
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
    
    public function naciniZakljuckaSrednjeSole()
    {
        return KoncanaSrednjaSola::all();
    }

    public function srednjeSole()
    {
        return SrednjaSola::all();
    }

    public function predmetiSplosneMature()
    {
        return Element::where('id', 'like', 'M%')->get();
    }

    public function prijavaZaStudij()
    {
        return [
            'visokosolskiZavodi' => VisokosolskiZavod::with('obcina')->get()->sortBy('ime'),
            'studijskiProgrami' => StudijskiProgram::all(),

        ];
    }
    
    public function pregledPrijave(Uporabnik $uporabnik)
    {
        return [
            'osebniPodatki' => $uporabnik->osebniPodatki()->first(),
            'stalnoPrebivalisce' => $uporabnik->prebivalisce()->with('obcina', 'posta', 'drzava')->first(),
            'naslovZaPosiljanje' => $uporabnik->naslovZaPosiljanje()->with('obcina', 'posta', 'drzava')->first(),
            'srednjesolskaIzobrazba' => $uporabnik->srednjesolskaIzobrazba()->with('nacinZakljucka', 'srednjaSola', 'drzava')->first(),
            'prijave' => $uporabnik->prijave()->with('studijskiProgram', 'studijskiProgram.visokosolskiZavod')->get()->sortBy('zelja')
        ];
    }
}