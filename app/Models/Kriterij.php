<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriterij extends Model
{
    protected $table = 'kriterij';
    protected $fillable = ['id_programa', 'id_elementa', 'utez'];
    protected $guarded = ['id'];
}
