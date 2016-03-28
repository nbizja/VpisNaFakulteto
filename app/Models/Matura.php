<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matura extends Model
{
    protected $table = 'matura';
    protected $fillable = ['emso', 'ime', 'priimek', 'uspeh', 'opravil', 'uspeh_3_letnik', 'uspeh_4_letnik', 'tip_kandidata', 'id_srednje_sole', 'id_poklica'];
}
