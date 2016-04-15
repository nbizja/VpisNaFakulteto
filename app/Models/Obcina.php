<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obcina extends Model
{
    public $timestamps = false;
    protected $table = 'obcina';
    protected $fillable = ['ime', 'vnos_veljaven'];
    protected $guarded = ['id'];
}
