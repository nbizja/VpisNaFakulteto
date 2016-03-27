<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VpisniPogoj extends Model
{
    protected $table = 'vpisni_pogoj';
    protected $fillable = ['id_programa', 'id_elementa', 'tip'];
    protected $guarded = ['id'];
}
