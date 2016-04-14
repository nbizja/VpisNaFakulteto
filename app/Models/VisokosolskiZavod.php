<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisokosolskiZavod extends Model
{    
    public $timestamps = false;
    protected $table = 'visokosolski_zavod';
    protected $fillable = ['ime', 'kratica', 'id_obcine', 'id_skrbnika'];
    protected $guarded = ['id'];
}
