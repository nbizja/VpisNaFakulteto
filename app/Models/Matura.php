<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matura extends Model
{
    public $timestamps = false;
    protected $table = 'matura';
    protected $fillable = ['emso', 'ime', 'priimek', 'uspeh', 'opravil', 'uspeh_3_letnik', 'uspeh_4_letnik', 'tip_kandidata', 'id_srednje_sole', 'id_poklica', 'vnos_veljaven'];
	protected $required = ['emso', 'ime', 'priimek', 'uspeh', 'opravil', 'uspeh_3_letnik', 'uspeh_4_letnik', 'tip_kandidata', 'id_srednje_sole', 'id_poklica'];
    public function getRequired()
    {
        return $this->required;
    }

    public function poklic()
    {
        return $this->belongsTo('App\Models\Poklic', 'id_poklica', 'id');
    }
}
