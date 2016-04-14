<?php
/**
 * Created by PhpStorm.
 * User: nejc
 * Date: 8. 04. 2016
 * Time: 11:27
 */

namespace App\Models\Logic;


class Validators
{
    CONST PASSWORD = 'required|min:8|regex:/^(?=.*[^a-zA-Z])/';

    public static function passwordMessage($imePolja)
    {
        return [
            $imePolja .'.regex' => "Geslo mora biti alfa-numerično.",
            $imePolja .'.min' => "Geslo mora vsebovati vsaj :min znakov.",
            'required' => "Zahtevana je izpolnjenost vseh polj.",
        ] ;
    }
}