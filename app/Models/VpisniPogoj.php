<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpisniPogoj extends Model
{
    public $timestamps = false;
    protected $table = 'vpisni_pogoj';
    protected $fillable = ['id_programa', 'id_elementa', 'tip'];
    protected $guarded = ['id'];
}
