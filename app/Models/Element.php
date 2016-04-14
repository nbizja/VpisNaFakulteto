<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    public $timestamps = false;
    protected $table = 'element';
    protected $fillable = ['ime'];
    protected $guarded = ['id'];
    public $incrementing = false;
}
