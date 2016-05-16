<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prijava extends Model
{
    use SoftDeletes;
    protected $table = 'prijava';
    protected $fillable = ['id_kandidata', 'id_studijskega_programa', 'zelja', 'datum_prijave', 'tocke', 'izredni_talent'];
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at', 'delete_at'];
    public $timestamps = false;

    public function studijskiProgram()
    {
        return $this->belongsTo('App\Models\StudijskiProgram', 'id_studijskega_programa');
    }
}
