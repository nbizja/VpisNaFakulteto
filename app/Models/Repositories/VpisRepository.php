<?php

namespace App\Models\Repositories;


use App\Models\Drzava;
use App\Models\Drzavljanstvo;
use App\Models\Obcina;

class VpisRepository
{
    public function podatkiPrviKorak()
    {
        return [
            'drzave' => Drzava::all(),
            'obcine' => Obcina::all(),
            'drzavljanstva' => Drzavljanstvo::all()
        ];
    }
    
    public function podatkiDrugiKorak()
    {
        return [
            
        ];
    }
    
}