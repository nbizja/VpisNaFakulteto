<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obcina extends Model
{
    protected $table = 'obcina';
    protected $fillable = ['ime'];
    protected $guarded = ['id'];
}
