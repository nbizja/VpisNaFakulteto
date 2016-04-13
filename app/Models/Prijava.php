<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prijava extends Model
{
    use SoftDeletes;
    protected $table = 'prijava';
    protected $fillable = ['id_kandidata', 'id_studijskega_programa', 'zelja', 'datum_prijave', 'tocke'];
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at', 'delete_at'];
    public $timestamps = false;
}
