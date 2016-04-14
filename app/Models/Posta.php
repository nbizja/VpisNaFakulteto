<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posta extends Model
{
    public $timestamps = false;
    protected $table = 'posta';
    protected $fillable = ['ime', 'postna_stevilka'];
}
