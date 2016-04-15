<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drzavljanstvo extends Model
{
    public $timestamps = false;
    protected $table = 'drzavljanstvo';
    protected $fillable = ['ime', 'vnos_veljaven'];
    protected $guarded = ['id'];
}
