<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KoncanaSrednjaSola extends Model
{
    public $timestamps = false;
    protected $table = 'koncana_srednja_sola';
    protected $fillable = ['ime', 'vnos_veljaven'];
    protected $guarded = ['id'];
	protected $required = ['ime'];
    
    public function getRequired()
    {
        return $this->required;
    }
}
