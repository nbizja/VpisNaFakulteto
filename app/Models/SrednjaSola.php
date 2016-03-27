<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SrednjaSola extends Model
{
    protected $table = 'srednja_sola';
    protected $fillable = ['ime'];
    protected $guarded = ['id'];
}
