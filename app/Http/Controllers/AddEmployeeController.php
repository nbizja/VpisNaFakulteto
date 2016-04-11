<?php

namespace App\Http\Controllers;

use App\Models\Enums\VlogaUporabnika;
use DB;
use Illuminate\Http\Request;
use App\Models\Uporabnik;

class AddEmployeeController extends Controller
{

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
        $password1 = $request->get('password1');
        $password2 = $request->get('password2');

        $message1 = '';
        $message2 = '';
        $message3 = '';
        $message4 = '';
        $message5 = '';
        $isValid = true;

        if(strlen($username) < 1 || strlen($email) < 1 || strlen($name) < 1 || strlen($surname) < 1 || strlen($password1) < 1 || strlen($password2) < 1)  {
            $isValid = false;
            $message1 = "Potrebno je izpolniti vsa polja!";
        }
        else {
            if(Uporabnik::where('username', '=', $username)->exists()) {
                $isValid = false;
                $message1 = "Uporabnik s takšnim uporabniškim imenom že obstaja!";
            }

            if(Uporabnik::where('email', '=', $email)->exists()) {
                $isValid = false;
                $message4 = "Uporabnik s takšnim email naslovom že obstaja!";
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $isValid = false;
                $message2 = "Neveljaven email naslov!";
            }

            if (!preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $password1) || strlen($password1) < 8) {
                $isValid = false;
                $message3 = "Geslo mora biti daljše od osmih znakov in vsebovati vsaj eno številko in črko!";
            }

            if(strcmp($password1, $password2) !== 0){
                $isValid = false;
                $message5 = "Vnešena gesla se ne ujemata!";
            }
        }

        if($isValid) {
            DB::table('uporabnik')->insert([
                'ime' => $name, 'priimek' => $surname, 'email' => $email, 'password' =>  bcrypt($password1), 'username' => $username, 'vloga' => VlogaUporabnika::SKRBNIK_PROGRAMA
            ]);

            $message0 = 'Uporabniški račun '. $username .' je bil uspešno ustvarjen!';

            return redirect('kreiranjeRacuna/zaposleni')
                ->with([
                    'message0' => $message0,
                ]);
        }
        else {
            return redirect('kreiranjeRacuna/zaposleni')
                ->withInput()
                ->with([
                    'message1' => $message1,
                    'message2' => $message2,
                    'message3' => $message3,
                    'message4' => $message4,
                    'message5' => $message5
                ]);
        }
    }
}