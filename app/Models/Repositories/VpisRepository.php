<?php

namespace App\Models\Repositories;


use App\Models\Drzava;
use App\Models\Drzavljanstvo;
use App\Models\Enums\NacinKoncanjaSrednjeSole;
use App\Models\Obcina;
use App\Models\Posta;
use App\Models\SrednjaSola;
use ReflectionClass;

class VpisRepository
{
    public function drzave()
    {
        return Drzava::all();
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
        $oClass = new ReflectionClass(NacinKoncanjaSrednjeSole::class);

        return $oClass->getConstants();
    }

    public function srednjeSole()
    {
        return SrednjaSola::all();
    }

    public function prijavaZaVpis()
    {
        
    }
    
}