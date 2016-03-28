<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poklic extends Model
{
    protected $table = 'poklic';
    protected $fillable = ['ime'];
    protected $guarded = ['id'];
}
