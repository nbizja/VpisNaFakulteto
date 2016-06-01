<?php

namespace App\Models\Repositories;


use App\Models\Prijava;
use App\Models\StudijskiProgram;

class RazvrscanjeRepository
{
    public function vrniVsePrijave()
    {
        return Prijava::with('uporabnik')->with('studijskiProgram');
    }
    
    public function programiZRavrstitvami()
    {
        return StudijskiProgram::with('rezultatiRazvrstitve')->with('kandidat');
    }
    
    public function vrniProgrameSPrijavamiSlovencev()
    {
        return StudijskiProgram::with('prijave')
            ->with('prijave.kandidat')
            ->whereExists(function($query) {
                $query->select('prijava.id')
                    ->from('prijava')
                    ->whereRaw('prijava.id_studijskega_programa = studijskiProgram.id');
            })
            ->where(function($query) {
                $query->aelect('1')->from('prijava_osebni_podatki')
                    ->where('prijava_osebni_podatki.id_kandidata', 'prijave.id_kandidata')
                    ->whereRaw('id_drzavljanstva NOT IN (2,6)');
            });
    }

    
}