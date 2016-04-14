<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poklic extends Model
{
    public $timestamps = false;
    protected $table = 'poklic';
    protected $fillable = ['ime'];
    protected $guarded = ['id'];
}
