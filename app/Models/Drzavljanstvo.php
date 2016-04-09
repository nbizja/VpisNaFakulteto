<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drzavljanstvo extends Model
{
    protected $table = 'drzavljanstvo';
    protected $fillable = ['ime'];
    protected $guarded = ['id'];
}
