<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Osebje extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'osebje';
    protected $fillable = ['email', 'geslo'];
    protected $guarded = ['id'];
    protected $hidden = ['geslo'];
}
