<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prijava extends Model
{
    protected $table = 'prijava';
    protected $fillable = ['id_kandidata', 'id_studijskega_programa', 'zelja', 'datum_prijave', 'tocke', 'izredni_talent', 'sprejet'];
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at', 'delete_at'];
    public $timestamps = false;

    public function studijskiProgram()
    {
        return $this->belongsTo('App\Models\StudijskiProgram', 'id_studijskega_programa');
    }

    public function kandidat()
    {
        return $this->belongsTo('App\Models\Uporabnik', 'id_kandidata');
    }

    public function srednjesolskaIzobrazba()
    {
        return $this->belongsTo('App\Models\PrijavaSrednjesolskaIzobrazba', 'id_kandidata', 'id_kandidata');
    }
}
