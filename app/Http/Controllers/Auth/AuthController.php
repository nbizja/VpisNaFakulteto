<?php

namespace App\Http\Controllers\Auth;

use App\Models\Uporabnik;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'logout']);
    }

    public function prijavniObrazec()
    {
        return view('auth.login');
    }

    /**
     * Prijava uporabnika
     *
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        if (Auth::attempt([
            'username' => $request->request->get('username'),
            'password' => $request->request->get('password'),
            'zeton' => ''
        ])) {
            $authenticatedUser = Auth::user();
            $authenticatedUser->zadnja_prijava = date('Y-m-d H:i:s');
            $authenticatedUser->save();

            return redirect()->intended('/');
        }

        return redirect('prijava')
                ->withInput()
                ->with([
                    'status' => 'danger',
                    'message' =>'Napačna prijava'
                ]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
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
