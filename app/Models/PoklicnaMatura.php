<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoklicnaMatura extends Model
{
    public $timestamps = false;
    protected $table = 'poklicna_matura';
    protected $fillable = ['emso', 'ime', 'priimek', 'uspeh', 'opravil', 'uspeh_3_letnik', 'uspeh_4_letnik', 'tip_kandidata', 'id_srednje_sole', 'id_poklica', 'maksimum'];

    public function poklic()
    {
        return $this->belongsTo('App\Models\Poklic', 'id_poklica', 'id');

    }
}
