<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoklicnaMaturaPredmet extends Model
{
    protected $table = 'poklicna_matura_predmet';
    protected $fillable = ['emso', 'id_predmeta', 'ocena', 'opravil', 'ocena_3_letnik', 'ocena_4_letnik', 'tip_predmeta'];
    protected $guarded = ['id'];
}
