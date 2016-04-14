<?php

namespace App\Http\Controllers;

use App\Models\Logic\Validators;
use App\Models\Poklic;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class SifrantiController extends Controller
{
    private $sifranti;
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {

                $seznam_sifrantov = array('drzava'=>'Država',
                   'drzavljanstvo'=>'Državljanstvo', 'element'=>'Element',
                   'koncana_srednja_sola'=>'Končana srednja šola','kriterij'=>'Kriterij',
                   'matura'=>'Matura', 'matura_predmet'=>'Maturitetni predmet',
                   'obcina'=>'Občina', 'poklic'=>'Poklic', 'posta'=>'Pošta',
                   'srednja_sola'=>'Srednja šola', 'studijski_program'=>'Študijski program',
                   'visokosolski_zavod'=>'Visokošolski zavod', 'vpisni_pogoj'=>'Vpisni pogoj');

                $sifranti_url = url('/sifranti/');
                return view('sifranti_seznam', compact('sifranti_url', 'seznam_sifrantov'));
            }
        }

        return redirect('prijava');
    }

    public function uredi($ime_sifranta)
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {

                $model = NULL;
                switch ($ime_sifranta) {
                    case 'drzava':
                    $model = 'App\Models\Drzava'; 
                    $title = 'Država';
                    $table_name = $ime_sifranta;
                    break;
                    case 'drzavljanstvo':
                    $model = 'App\Models\Drzavljanstvo'; 
                    $title = 'Državljanstvo';
                    $table_name = $ime_sifranta;
                    break;
                    case 'element':
                    $model = 'App\Models\Element'; 
                    $title = 'Element';
                    $table_name = $ime_sifranta;
                    break;
                    case 'koncana_srednja_sola':
                    $model = 'App\Models\KoncanaSrednjaSola'; 
                    $title = 'Končana srednja šola';
                    $table_name = $ime_sifranta;
                    break;
                    case 'kriterij':
                    $model = 'App\Models\Kriterij'; 
                    $title = 'Kriterij';
                    $table_name = $ime_sifranta;
                    break;
                    case 'matura':
                    $model = 'App\Models\Matura'; 
                    $title = 'Matura';
                    $table_name = $ime_sifranta;
                    break;
                    case 'matura_predmet':
                    $model = 'App\Models\MaturaPredmet'; 
                    $title = 'Maturitetni predmet';
                    $table_name = $ime_sifranta;
                    break;
                    case 'obcina':
                    $model = 'App\Models\Obcina'; 
                    $title = 'Občina';
                    $table_name = $ime_sifranta;
                    break;
                    case 'poklic':
                    $model = 'App\Models\Poklic'; 
                    $title = 'Poklic';
                    $table_name = $ime_sifranta;
                    break;
                    case 'posta':
                    $model = 'App\Models\Posta'; 
                    $title = 'Pošta';
                    $table_name = $ime_sifranta;
                    break;
                    case 'srednja_sola':
                    $model = 'App\Models\SrednjaSola'; 
                    $title = 'Srednja šola';
                    $table_name = $ime_sifranta;
                    break;
                    case 'studijski_program':
                    $model = 'App\Models\StudijskiProgram'; 
                    $title = 'Študijski program';
                    $table_name = $ime_sifranta;
                    break;
                    case 'visokosolski_zavod':
                    $model = 'App\Models\VisokosolskiZavod'; 
                    $title = 'Visokošolski zavod';
                    $table_name = $ime_sifranta;
                    break;
                    case 'vpisni_pogoj':
                    $model = 'App\Models\VpisniPogoj'; 
                    $title = 'Vpisni pogoj';
                    $table_name = $ime_sifranta;
                    break;
                    default:
                    return redirect('prijava');
                }

                $edit = \DataEdit::source(new $model);
                $edit->link('sifranti/' . $ime_sifranta, 'Nazaj', 'TR')->back();
                $fields = \DB::getSchemaBuilder()->getColumnListing($table_name);
                foreach($fields as $field)
                {
                    $field_name = ucfirst(str_replace('_', ' ', $field));
                    $edit->add($field, $field_name, 'text');
                }

                return $edit->view('sifrant_uredi', compact('edit', 'title'));
            }
        }

        return redirect('prijava');
    }

    private function prikazi_sifrant($model, $title, $table_name, $filter_columns = NULL)
    {
        $columns = \DB::getSchemaBuilder()->getColumnListing($table_name);


        $filter = \DataFilter::source(new $model);
        if (is_null($filter_columns))
        {
            $filter_columns = array('id', 'ime');
        }
        foreach($filter_columns as $col)
        {
            $col_name = ucfirst(str_replace('_', ' ', $col));
            $filter->add($col, $col_name, 'text');
        }
        $filter->submit('Išči');
        $filter->reset('Razveljavi');
        $filter->build();


        $grid = \DataGrid::source($filter);
        foreach($columns as $col)
        {
            $col_name = ucfirst(str_replace('_', ' ', $col));
            $grid->add($col, $col_name, true);
        }
        $grid->edit(url('/sifranti/'. $table_name .'/edit'), 'Uredi','modify|delete');
        $grid->paginate(20);

        $add_url = url('/sifranti/'. $table_name .'/edit');


        return view('sifranti', compact('filter', 'grid', 'title', 'add_url'));
    }

    public function prikazi($ime_sifranta)
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {

                switch ($ime_sifranta) {
                    case 'drzava':
                    return $this->prikazi_sifrant('App\Models\Drzava', 'Države', $ime_sifranta);
                    case 'drzavljanstvo':
                    return $this->prikazi_sifrant('App\Models\Drzavljanstvo', 'Državljanstva', $ime_sifranta);
                    case 'element':
                    return $this->prikazi_sifrant('App\Models\Element', 'Elementi', $ime_sifranta);
                    case 'koncana_srednja_sola':
                    return $this->prikazi_sifrant('App\Models\KoncanaSrednjaSola', 'Končane srednje šole', $ime_sifranta);
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
                    return $this->prikazi_sifrant('App\Models\Posta', 'Pošte', $ime_sifranta, array('postna_stevilka', 'ime'));
                    case 'srednja_sola':
                    return $this->prikazi_sifrant('App\Models\SrednjaSola', 'Srednje šole', $ime_sifranta);
                    case 'studijski_program':
                    return $this->prikazi_sifrant('App\Models\StudijskiProgram', 'Študijski programi', $ime_sifranta);
                    case 'visokosolski_zavod':
                    return $this->prikazi_sifrant('App\Models\VisokosolskiZavod', 'Visokošolski zavodi', $ime_sifranta);
                    case 'vpisni_pogoj':
                    return $this->prikazi_sifrant('App\Models\VpisniPogoj', 'Vpisni pogoji', $ime_sifranta);
                    default:
                    return redirect('prijava');
                }

            }
        }

        return redirect('prijava');
    }
}
