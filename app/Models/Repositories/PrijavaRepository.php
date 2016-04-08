<?php
/**
 * Created by PhpStorm.
 * User: nejc
 * Date: 4. 04. 2016
 * Time: 12:41
 */

namespace App\Models\Repositories;


use App\Models\Enums\VlogaUporabnika;
use App\Models\Uporabnik;

class PrijavaRepository
{
    public function uporabnikByUsername($username)
    {
        return Uporabnik::where('username', $username)->first();
    }

    public function uporabnikByEmail($email)
    {
        return Uporabnik::where('email', $email)->first();
    }

    public function uporabnikByZeton($zeton)
    {
        return Uporabnik::where('zeton', $zeton)->first();
    }
}