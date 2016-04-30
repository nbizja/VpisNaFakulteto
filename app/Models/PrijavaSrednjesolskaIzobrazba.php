<?php
/**
 * Created by PhpStorm.
 * User: Nejc
 * Date: 30.4.2016
 * Time: 15:26
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PrijavaSrednjesolskaIzobrazba extends Model
{
    protected $table = 'prijava_srednjesolska_izobrazba';
    protected $fillable = ['id_kandidata', 'id_nacina_koncanja', 'id_srednje_sole'];
    protected $guarded = ['id'];
    public $timestamps = true;


    public function nacinKoncanjaSrednjeSole()
    {
        return $this->belongsTo('App/Models/KoncanaSrednjaSola', 'id_nacina_koncanja');
    }

    public function srednjaSola()
    {
        return $this->belongsTo('App/Models/SrednjaSola', 'id_srednje_sole');
    }
}