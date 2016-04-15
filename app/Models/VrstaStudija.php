<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VrstaStudija extends Model
{
    public $timestamps = false;
    protected $table = 'vrsta_studija';
    protected $fillable = ['ime'];
    protected $guarded = ['id'];
}
