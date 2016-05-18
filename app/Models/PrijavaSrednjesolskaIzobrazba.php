<?php
/**
 * Created by PhpStorm.
 * User: Nejc
 * Date: 30.4.2016
 * Time: 15:26
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PrijavaSrednjesolskaIzobrazba extends Model
{
    protected $table = 'prijava_srednjesolska_izobrazba';
    protected $fillable = ['id_kandidata', 'ima_spricevalo', 'id_nacina_zakljucka', 'id_drzave', 'id_srednje_sole', 'id_maturitetnega_predmeta', 'ime_srednje_sole', 'datum_izdaje_spricevala'];
    protected $guarded = ['id'];
    public $timestamps = true;


    public function srednjaSola()
    {
        return $this->belongsTo('App\Models\SrednjaSola', 'id_srednje_sole', 'id');
    }

    public function nacinZakljucka()
    {
        return $this->belongsTo('App\Models\KoncanaSrednjaSola', 'id_nacina_zakljucka', 'id');
    }

    public function maturitetniPredmet()
    {
        return $this->belongsTo('App\Models\Element', 'id_maturitetnega_predmeta', 'id');
    }
    
    public function srednjesolskaIzobrazba()
    {
        return $this->belongsTo('App\Models\PrijavaSrednjesolskaIzobrazba', 'id_srednje_sole', 'id');
    }

    public function drzava()
    {
        return $this->belongsTo('App\Models\Drzava', 'id_drzave', 'id');
    }
}