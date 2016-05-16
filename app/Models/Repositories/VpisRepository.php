<?php

namespace App\Models\Repositories;


use App\Models\Drzava;
use App\Models\Drzavljanstvo;
use App\Models\Element;
use App\Models\KoncanaSrednjaSola;
use App\Models\Obcina;
use App\Models\Posta;
use App\Models\SrednjaSola;
use App\Models\StudijskiProgram;
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
            'visokosolskiZavodi' => VisokosolskiZavod::with('obcina'),
            'studijskiProgrami' => StudijskiProgram::all(),

        ];
    }
}