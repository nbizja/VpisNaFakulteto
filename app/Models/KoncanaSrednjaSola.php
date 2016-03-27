<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KoncanaSrednjaSola extends Model
{
    protected $table = 'koncana_srednja_sola';
    protected $fillable = ['ime'];
    protected $guarded = ['id'];
}
