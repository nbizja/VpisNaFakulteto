<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PrijavaOsebniPodatki extends Model
{
    protected $table = 'prijava_osebni_podatki';
    protected $fillable = ['id_kandidata', 'emso', 'ime', 'priimek', 'datum_rojstva', 'id_drzave_rojstva', 'kraj_rojstva', 'id_drzavljanstva', 'kontaktni_telefon', 'veljavno'];
    protected $guarded = ['id'];
    public $timestamps = true;

    public function jeVeljavno()
    {
        return (bool) $this->veljavno;
    }
    
    public function kandidat()
    {
        return $this->belongsTo('App\Models\Uporabnik', 'id_kandidata');
    }

    public function drzavaRojstva()
    {
        return $this->belongsTo('App\Models\Drzava', 'id_drzava_rojstva');
    }

    public function drzavljanstvo()
    {
        return $this->belongsTo('App\Models\Drzavljanstvo', 'id_drzavljanstva');
    }

}