<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpisniPogoj extends Model
{
    public $timestamps = false;
    protected $table = 'vpisni_pogoj';
    protected $fillable = ['id_programa', 'id_elementa', 'id_elementa2', 'id_poklica', 'tip', 'splosna_matura', 'poklicna_matura', 'vnos_veljaven'];
    protected $guarded = ['id'];
    protected $required = ['id_programa'];

    public function getRequired()
    {
        return $this->required;
    }

    public function Element()
    {
        return $this->belongsTo('App\Models\Element', 'id_elementa','id');
    }

    public function Poklic()
    {
        return $this->belongsTo('App\Models\Poklic', 'id_poklica','id');
    }

    public function Element2()
    {
        return $this->belongsTo('App\Models\Element', 'id_elementa2','id');
    }
}