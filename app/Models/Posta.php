<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posta extends Model
{
    protected $table = 'posta';
    protected $fillable = ['ime', 'postna_stevilka'];
}
