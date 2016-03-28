<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $table = 'element';
    protected $fillable = ['ime'];
    protected $guarded = ['id'];
}
