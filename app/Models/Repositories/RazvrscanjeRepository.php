<?php

namespace App\Models\Repositories;


use App\Models\Prijava;
use App\Models\StudijskiProgram;
use App\Models\Uporabnik;

class RazvrscanjeRepository
{
    public function vrniVsePrijave()
    {
        return Prijava::with('uporabnik')->with('studijskiProgram');
    }
    
    public function programiZRavrstitvami()
    {
        return StudijskiProgram::with('prijave')
            ->with('prijave.kandidat')
            ->whereExists(function($query) {
                $query->select('prijava.id')
                    ->from('prijava')
                    ->whereRaw('prijava.id_studijskega_programa = studijski_program.id');
            });
    }
    
    public function vrniProgrameSPrijavamiSlovencev()
    {
        return StudijskiProgram::with('prijave')
            ->with('prijave.kandidat')
            ->whereExists(function($query) {
                $query->select('prijava.id')
                    ->from('prijava')
                    ->whereRaw('prijava.id_studijskega_programa = studijski_program.id');
            });
        /*
            ->where(function($query) {
                $query->aelect('1')->from('prijava_osebni_podatki')
                    ->where('prijava_osebni_podatki.id_kandidata', 'prijave.id_kandidata')
                    ->whereRaw('id_drzavljanstva NOT IN (2,6)');
            });
        */
    }

    public function kandidati()
    {
        return Uporabnik::where('vloga','kandidat');
    }

    
}