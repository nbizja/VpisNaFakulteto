<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudijskiProgram extends Model
{
    protected $table = 'studijski_program';
    protected $fillable = ['sifra', 'vrsta', 'id_zavoda', 'nacin_studija', 'ime', 'vnos_veljaven',
        'stevilo_vpisnih_mest', 'stevilo_mest_po_omejitvi', 'stevilo_sprejetih', 'omejitev_vpisa',
        'stevilo_vpisnih_mest_tujci',  'stevilo_mest_po_omejitvi_tujci', 'stevilo_sprejetih_tujci', 'omejitev_vpisa_tujci'];
    protected $guarded = ['id'];
	protected $required = ['sifra', 'vrsta', 'id_zavoda', 'nacin_studija', 'ime', 'stevilo_vpisnih_mest', 'stevilo_mest_po_omejitvi', 'omejitev_vpisa'];
    public $timestamps = false;

    public function visokosolskiZavod()
    {
        return $this->belongsTo('App\Models\VisokosolskiZavod', 'id_zavoda','id');
    }

    public function VpisniPogoji()
    {
        return $this->hasMany('App\Models\VpisniPogoj', 'id_programa','id');
    }
	
    public function getRequired()
    {
        return $this->required;
    }

    public function prijave()
    {
        return $this->hasMany('App\Models\Prijava', 'id_studijskega_programa');
    }
    
    public function prijaveSlovenci()
    {
        return $this->prijave->filter();
    }
}
