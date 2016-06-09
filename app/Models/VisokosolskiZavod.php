<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisokosolskiZavod extends Model
{    
    public $timestamps = false;
    protected $table = 'visokosolski_zavod';
    protected $fillable = ['ime', 'kratica', 'id_obcine', 'id_skrbnika', 'vnos_veljaven'];
    protected $guarded = ['id'];
	protected $required = ['ime', 'kratica', 'id_obcine'];

    public function getRequired()
    {
        return $this->required;
    }

    public function obcina()
    {
        return $this->belongsTo('App\Models\Obcina', 'id_obcine', 'id');
    }

    public function programi()
    {
        return $this->hasMany('App\Models\StudijskiProgram', 'id_zavoda', 'id');
    }

    public function prijave()
    {
        return $this->programi()->with('prijave');
    }
}
