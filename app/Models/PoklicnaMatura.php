<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoklicnaMatura extends Model
{
    public $timestamps = false;
    protected $table = 'poklicna_matura';
    protected $fillable = ['emso', 'ime', 'priimek', 'uspeh', 'opravil', 'uspeh_3_letnik', 'uspeh_4_letnik', 'tip_kandidata', 'id_srednje_sole', 'id_poklica', 'maksimum'];
    protected $required = ['emso', 'ime', 'priimek', 'uspeh', 'opravil', 'uspeh_3_letnik', 'uspeh_4_letnik', 'tip_kandidata', 'id_srednje_sole', 'id_poklica'];

    public function poklic()
    {
        return $this->belongsTo('App\Models\Poklic', 'id_poklica', 'id');

    }

    public function getRequired()
    {
        return $this->required;
    }
	
	public function dodaj($polja)
	{
		$emso = $polja['emso'];
		$obstojeci = $this->where('emso', '=', $emso)->first();
		if (is_null($obstojeci)) {
			$this->insert($polja);
		} else {
			$this->where('id', $obstojeci['id'])->update($polja);
		}
	}
}
