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
        return Drzava::all()->sortBy('ime');
    }

    public function drzavljanstva()
    {
        return Drzavljanstvo::all()->sortBy('ime');
    }

    public function obcine()
    {
        return Obcina::all()->sortBy('ime');
    }

    public function poste()
    {
        return Posta::all();
    }

    public function predmetiSplosneMature()
    {
        return Element::where('id', 'like', 'M%')->get()->sortBy('ime');
    }

    public function stalnoPrebivalisce(Uporabnik $uporabnik)
    {
        return [
            'stalnoPrebivalisce' => $uporabnik->prebivalisce()->first(),
            'naslovZaPosiljanje' => $uporabnik->naslovZaPosiljanje()->first(),
            'drzave' => $this->drzave(),
            'obcine' => $this->obcine(),
            'poste' => $this->poste()
        ];
    }

    public function srednjesolskaIzobrazba(Uporabnik $uporabnik)
    {
        return [
            'naciniZakljucka' => KoncanaSrednjaSola::all()->sortBy('ime'),
            'srednjeSole' => SrednjaSola::all()->sortBy('ime'),
            'splosniPredmeti' => $this->predmetiSplosneMature(),
            'drzave' => Drzava::all()->sortBy('ime'),
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