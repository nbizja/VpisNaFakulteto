<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 6.4.2016
 * Time: 17:53
 */

namespace App\Models\Logic;
use App\Models\Uporabnik;

class Registracija
{
    public function createUser(array $data)
    {
        return Uporabnik::create([
            'ime' => $data['ime'],
            'priimek' => $data['priimek'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'zeton' => str_random(10),
        ]);
    }

}