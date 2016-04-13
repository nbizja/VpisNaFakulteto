<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SrednjaSola extends Model
{
    protected $table = 'srednja_sola';
    protected $fillable = ['ime'];
    protected $guarded = ['id'];
}
