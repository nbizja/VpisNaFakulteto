<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PrijavaPrebivalisce extends Model
{
    protected $table = 'prijava_stalno_prebivalisce';
    protected $fillable = ['id_kandidata', 'id_drzave', 'naslov', 'id_obcine', 'postna_stevilka'];
    protected $guarded = ['id'];
    public $timestamps = true;

    public function drzava()
    {
        return $this->belongsTo('App/Models/Drzava', 'id_drzave');
    }

    public function obcina()
    {
        return $this->belongsTo('App/Models/Obcina', 'id_obcine');
    }

    public function posta()
    {
        return $this->belongsTo('App/Models/Posta', 'postna_stevilka');
    }
}