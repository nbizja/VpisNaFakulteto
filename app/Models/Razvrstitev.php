<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Razvrstitev extends Model
{
    protected $table = 'razvrstitev';
    protected $fillable = ['id_programa', 'id_kandidata','id_prijave', 'mesto', 'stevilo_tock', 'zelja', 'vzrok_za_zavrnitev'];
    protected $guarded = ['id'];

    public function kandidat()
    {
        return $this->belongsTo('App\Models\Uporabnik', 'id_kandidata');
    }

    public function program()
    {
        return $this->belongsTo('App\Models\StudijskiProgram', 'id_programa');
    }
}