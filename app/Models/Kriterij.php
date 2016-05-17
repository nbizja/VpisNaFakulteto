<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriterij extends Model
{
    public $timestamps = false;
    protected $table = 'kriterij';
    protected $fillable = ['id_pogoja', 'ocene_34_letnika', 'maturitetni_uspeh', 'id_elementa', 'utez', 'vnos_veljaven'];
    protected $guarded = ['id'];
    protected $required = ['id_pogoja', 'utez'];
    public function getRequired()
    {
        return $this->required;
    }

    public function Element()
    {
        return $this->belongsTo('App\Models\Element', 'id_elementa','id');
    }
}
