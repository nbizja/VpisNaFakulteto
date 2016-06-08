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
        return StudijskiProgram::with('prijave')
            ->with('prijave.kandidat')
            ->whereExists(function($query) {
                $query->select('prijava.id')
                    ->from('prijava')
                    ->whereRaw('prijava.id_studijskega_programa = studijski_program.id');
            });
    }
    
    public function vrniProgrameSPrijavami()
    {
        return StudijskiProgram::with('prijave')
            ->with('prijave.kandidat')
            ->with('prijave.kandidat.osebniPodatki')
            ->whereExists(function($query) {
                $query->select('prijava.id')
                    ->from('prijava')
                    ->whereRaw('prijava.id_studijskega_programa = studijski_program.id');
            });
    }
}