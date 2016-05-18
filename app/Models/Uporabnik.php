<?php

namespace App\Models;

use App\Models\Enums\VlogaUporabnika;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Uporabnik extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'uporabnik';
    protected $fillable = ['ime', 'priimek', 'email', 'username','password', 'zeton', 'zadnja_prijava', 'datum_oddaje_prijave'];
    protected $guarded = ['id', 'remember_token'];
    protected $hidden = ['password', 'remember_token'];
    public $timestamps = true;

    public function jeAdministrator()
    {
        return $this->vloga == VlogaUporabnika::ADMIN;
    }

    public function jeSkrbnik()
    {
        return $this->vloga == VlogaUporabnika::SKRBNIK_PROGRAMA;
    }

    public function jeKandidat()
    {
        return $this->vloga = VlogaUporabnika::KANDIDAT;
    }
    public function prikazVloge()
    {
        if ($this->vloga == VlogaUporabnika::SKRBNIK_PROGRAMA) {
                return 'VPIS';
        }

        return ucfirst($this->vloga);
    }

    public function osebniPodatki()
    {
        return $this->hasMany('App\Models\PrijavaOsebniPodatki', 'id_kandidata', 'id');
    }

    public function prebivalisce()
    {
        return $this->hasMany('App\Models\PrijavaPrebivalisce', 'id_kandidata', 'id');
    }

    public function naslovZaPosiljanje()
    {
        return $this->hasMany('App\Models\PrijavaNaslovZaPosiljanje', 'id_kandidata', 'id');
    }
    
    public function srednjesolskaIzobrazba()
    {
        return $this->hasMany('App\Models\PrijavaSrednjesolskaIzobrazba', 'id_kandidata', 'id');
    }

    public function prijave()
    {
        return $this->hasMany('App\Models\Prijava', 'id_kandidata', 'id');

    }



}
