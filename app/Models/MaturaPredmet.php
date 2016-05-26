<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaturaPredmet extends Model
{
    public $timestamps = false;
    protected $table = 'matura_predmet';
    protected $fillable = ['emso', 'id_predmeta', 'ocena', 'opravil', 'ocena_3_letnik', 'ocena_4_letnik', 'tip_predmeta', 'vnos_veljaven'];
	protected $required = ['emso', 'id_predmeta', 'ocena', 'opravil', 'ocena_3_letnik', 'ocena_4_letnik', 'tip_predmeta'];

    public function getRequired()
    {
        return $this->required;
    }

    public function predmet()
    {
       return $this->belongsTo('App\Models\Element', 'id_predmeta', 'id');
    }
	
	public function dodaj($polja)
	{
		$emso = $polja['emso'];
		$id_predmeta = $polja['id_predmeta'];
		$obstojeci = $this->where('emso', '=', $emso)->where('id_predmeta', '=', $id_predmeta)->first();
		if (is_null($obstojeci)) {
			$this->insert($polja);
		} else {
			$this->where('id', $obstojeci['id'])->update($polja);
		}
	}
}
