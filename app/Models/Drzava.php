<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drzava extends Model
{
    public $timestamps = false;
    protected $table = 'drzava';
    protected $fillable = ['ime', 'eu', 'vnos_veljaven'];
    protected $guarded = ['id'];
    protected $required = ['id', 'ime', 'eu'];
    public function getRequired()
    {
        return $this->required;
    }
}
