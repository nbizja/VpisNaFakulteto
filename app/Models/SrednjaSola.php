<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SrednjaSola extends Model
{
    public $timestamps = false;
    protected $table = 'srednja_sola';
    protected $fillable = ['ime', 'vnos_veljaven'];
    protected $guarded = ['id'];
	protected $required = ['ime'];
    
    public function getRequired()
    {
        return $this->required;
    }
}
