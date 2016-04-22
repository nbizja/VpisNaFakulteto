<?php
/**
 * Created by PhpStorm.
 * User: nejc
 * Date: 15. 04. 2016
 * Time: 09:13
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PozabljenoGeslo extends Model
{
    public $timestamps = true;
    protected $table = 'pozabljeno_geslo';
    protected $fillable = ['id_uporabnika', 'novo_geslo', 'zeton', 'veljavnost'];
    protected $guarded = ['id'];
}