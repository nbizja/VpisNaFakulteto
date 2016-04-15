<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    public $timestamps = false;
    protected $table = 'element';
    protected $fillable = ['ime', 'vnos_veljaven'];
    protected $guarded = ['id'];
    public $incrementing = false;
}
