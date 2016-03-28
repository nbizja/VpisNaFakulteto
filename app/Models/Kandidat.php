<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Kandidat extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'kandidat';
    protected $fillable = ['ime', 'priimek', 'emso', 'uporabnisko_ime', 'email', 'geslo', 'zeton', 'obcina_rojstva', 'drzava', 'drzavljanstvo'];
    protected $guarded = ['id'];
    protected $hidden = ['geslo'];

}
