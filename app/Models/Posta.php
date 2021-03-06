<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posta extends Model
{
    public $timestamps = false;
    protected $table = 'posta';
    protected $fillable = ['ime', 'postna_stevilka', 'vnos_veljaven'];
    public $primaryKey = 'postna_stevilka';
	protected $required = ['ime', 'postna_stevilka'];
    
    public function getRequired()
    {
        return $this->required;
    }
}
