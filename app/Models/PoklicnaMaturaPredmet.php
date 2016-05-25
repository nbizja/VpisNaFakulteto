<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoklicnaMaturaPredmet extends Model
{
    public $timestamps = false;
    protected $table = 'poklicna_matura_predmet';
    protected $fillable = ['emso', 'id_predmeta', 'ocena', 'opravil', 'ocena_3_letnik', 'ocena_4_letnik', 'tip_predmeta']; protected $required = ['emso', 'id_predmeta', 'ocena', 'opravil', 'ocena_3_letnik', 'ocena_4_letnik', 'tip_predmeta'];
    protected $required = ['emso', 'id_predmeta', 'ocena', 'opravil', 'ocena_3_letnik', 'ocena_4_letnik', 'tip_predmeta'];
    protected $guarded = ['id'];

    public function predmet()
    {
        return $this->belongsTo('App\Models\Element', 'id_predmeta', 'id');
    }
   
    public function getRequired()
    {
        return $this->required;
    }
}
