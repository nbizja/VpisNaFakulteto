<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $table = 'element';
    protected $fillable = ['ime'];
    protected $guarded = ['id'];
}
