<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrijavniRok extends Model
{
    public $timestamps = false;
    protected $table = 'prijavni_rok';
    protected $fillable = ['ime', 'studijsko_leto', 'zacetek', 'konec'];
    protected $guarded = ['id'];
}
