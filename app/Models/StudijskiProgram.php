<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudijskiProgram extends Model
{
    protected $table = 'studijski_program';
    protected $fillable = ['id_zavoda', 'nacin', 'ime', 'stevilo_vpisnih_mest', 'omejitev_vpisa'];
    protected $guarded = ['id'];
}
