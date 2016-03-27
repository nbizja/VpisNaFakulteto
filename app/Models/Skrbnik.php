<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class Skrbnik extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'skrbnik';
    protected $fillable = ['ime', 'priimek', 'uporabnisko_ime', 'email', 'vloga'];
    protected $guarded = ['id', 'password', 'remeber_token'];
    protected $hidden = ['password', 'remember_token'];
}