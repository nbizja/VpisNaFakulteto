<?php

namespace App\Models\Repositories;


use App\Models\StudijskiProgram;
use App\Models\Uporabnik;

class RazvrscanjeRepository
{
    public function vrniVsePrijavljeneKandidate()
    {
        //return Uporabnik::where('')
    }
    
    public function programiZRavrstitvami()
    {
        return StudijskiProgram::with('rezultatiRazvrstitve')->with('kandidat');
    }
}