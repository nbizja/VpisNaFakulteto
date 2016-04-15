<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drzava extends Model
{
    public $timestamps = false;
    protected $table = 'drzava';
    protected $fillable = ['ime', 'eu'];
    protected $guarded = ['id'];
}
