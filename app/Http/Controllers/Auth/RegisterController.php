<?php

namespace App\Http\Controllers\Auth;

use App\Models\Uporabnik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class RegisterController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';


    /**
     * Registracija uporabnika
     *
     * @param Request $request
     * @return mixed
     */
    public function showRegister(Request $request)
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $messages = [
            'required' => "Zahtevana je izpolnjenost vseh polj.",
            'email' => "Email naslov neveljaven.",
            'password.regex' => "Geslo mora biti alfa-numerično.",
            'password.min' => "Geslo mora vsebovati vsaj :min znakov.",
            'email.unique' => "Email je že v uporabi.",
            'username.unique' => "Uporabniško ime je že v uporabi.",
        ];

        $validator = Validator::make($request->all(), [
            'ime' => 'required|max:30',
            'priimek' => 'required|max:30',
            'email' => 'required|email|max:30|unique:uporabnik,email',
            'password' => 'required|min:8|regex:/^(?=.*[^a-zA-Z])/',
            'username' => 'required|max:30|unique:uporabnik,username',
        ], $messages);



        if( $validator->passes() ) {
            $this->sendActivationEmail("nezabelej@gmail.com");
            return "jej";
            //ustvari uporabnika, poslji email...
        } else {
            return view('auth.register')
                ->with(['errors' => $validator->errors()->all()]);
        }

    }

    public function sendActivationEmail($email)
    {
        Mail::send('auth.emails.registration', [], function ($m) use($email){
            $m->from('skrbnik@faks.me', 'Vpis v visoko šolstvo.');
            $m->to($email)->subject('Aktivacija računa');
        });
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Uporabnik
     */
    protected function create(array $data)
    {
        return Uporabnik::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
