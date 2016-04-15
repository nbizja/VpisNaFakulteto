<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriterij extends Model
{
    public $timestamps = false;
    protected $table = 'kriterij';
    protected $fillable = ['id_programa', 'id_elementa', 'utez', 'vnos_veljaven'];
    protected $guarded = ['id'];
	protected $required = ['id_programa', 'id_elementa', 'utez'];
    public function getRequired()
    {
        return $this->required;
    }
}
