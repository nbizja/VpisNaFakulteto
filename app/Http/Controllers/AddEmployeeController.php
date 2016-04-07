<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Uporabnik;

class AddEmployeeController extends Controller
{

    // za zaposlene v VPIS in študentskih referatih (vseeno, itak ime in priimek)

    // uporabnisko ime
    // email naslov
    // ime, priimek
    // geslo

    // preveri strukturo
    // preveri ustreznost gesla (8 znakov, vsaj 1 numericen)
    // preveri, da se nov uporabnik lahko prijavi v sistem


    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function loadPage()
    {
        return view('add_employee');
    }

    public function validateInput(Request $request)
    {
        $username = $request->get('username');
        $email = $request->get('email');
        $name = $request->get('name');
        $surname = $request->get('surname');
        $password = $request->get('password');

        $message1 = '';
        $message2 = '';
        $message3 = '';
        $message4 = '';
        $isValid = true;

        if(strlen($username) < 1 || strlen($email) < 1 || strlen($name) < 1 || strlen($surname) < 1 || strlen($password) < 1)
        {
            $isValid = false;
            $message1 = "Potrebno je izpolniti vsa polja!";
        }
        else {
            if(Uporabnik::where('username', '=', $username)->exists())
            {
                $isValid = false;
                $message1 = "Uporabnik s takšnim uporabniškim imenom že obstaja!";
            }

            if(Uporabnik::where('email', '=', $email)->exists())
            {
                $isValid = false;
                $message4 = "Uporabnik s takšnim email naslovom že obstaja!";
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $isValid = false;
                $message2 = "Neveljaven email naslov!";
            }

            if (!preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $password) || strlen($password) < 8)
            {
                $isValid = false;
                $message3 = "Geslo mora biti daljše od osmih znakov in vsebovati vsaj eno številko in črko!";
            }
        }

        if($isValid)
        {
            DB::table('uporabnik')->insert([
                'ime' => $name, 'priimek' => $surname, 'email' => $email, 'password' => $password, 'username' => $username
            ]);

            redirect('/');
        }
        else
        {
            return redirect('kreiranjeRacuna/zaposleni')
                ->withInput()
                ->with([
                    'message1' => $message1,
                    'message2' => $message2,
                    'message3' => $message3,
                    'message4' => $message4
                ]);
        }
    }
}