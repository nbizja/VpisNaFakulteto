<?php

namespace App\Http\Controllers;

use App\Models\Logic\Validators;
use App\Models\Poklic;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SifrantiController extends Controller
{
    public function index()
    {
        return view('sifranti');
    }
    
    private function prikazi_sifrant($model, $title, $table_name)
    {
        $items = $model::all();
        $columns = array();
        if (count($items) > 0)
        {
            $columns = \DB::getSchemaBuilder()->getColumnListing($table_name);
        }
        return view('sifranti', array(
            'items' => $items,
            'columns' => $columns,
            'title' => $title));
    }

    public function prikazi($ime_sifranta)
    {
        switch ($ime_sifranta) {
        case 'drzava':
            return $this->prikazi_sifrant('App\Models\Drzava', 'Država', $ime_sifranta);
        case 'drzavljanstvo':
            return $this->prikazi_sifrant('App\Models\Drzavljanstvo', 'Državljanstvo', $ime_sifranta);
        case 'element':
            return $this->prikazi_sifrant('App\Models\Element', '', $ime_sifranta);
        case 'koncana_srednja_sola':
            return $this->prikazi_sifrant('App\Models\KoncanaSrednjaSola', 'Končana srednja šola', $ime_sifranta);
        case 'kriterij':
            return $this->prikazi_sifrant('App\Models\Kriterij', 'Kriteriji', $ime_sifranta);
        case 'matura':
            return $this->prikazi_sifrant('App\Models\Matura', 'Matura', $ime_sifranta);
        case 'matura_predmet':
            return $this->prikazi_sifrant('App\Models\MaturaPredmet', 'Maturitetni predmeti', $ime_sifranta);
        case 'obcina':
            return $this->prikazi_sifrant('App\Models\Obcina', 'Občine', $ime_sifranta);
        case 'poklic':
            return $this->prikazi_sifrant('App\Models\Poklic', 'Poklici', $ime_sifranta);
        case 'posta':
            return $this->prikazi_sifrant('App\Models\Posta', 'Pošte', $ime_sifranta);
        case 'srednja_sola':
            return $this->prikazi_sifrant('App\Models\SrednjaSola', 'Srednje šole', $ime_sifranta);
        case 'studijski_program':
            return $this->prikazi_sifrant('App\Models\StudijskiProgram', 'Študijski programi', $ime_sifranta);
        case 'visokosolski_zavod':
            return $this->prikazi_sifrant('App\Models\VisokosolskiZavod', 'Visokošolski zavodi', $ime_sifranta);
        case 'vpisni_pogoj':
            return $this->prikazi_sifrant('App\Models\VpisniPogoj', 'Vpisni pogoji', $ime_sifranta);
        
        default:
            return view('error');
        }
    }
}
