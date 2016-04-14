<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SrednjaSola extends Model
{
    public $timestamps = false;
    protected $table = 'srednja_sola';
    protected $fillable = ['ime'];
    protected $guarded = ['id'];
}
