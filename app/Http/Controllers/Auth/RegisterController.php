<?php

namespace App\Http\Controllers\Auth;

use App\Models\Enums\VlogaUporabnika;
use App\Models\Logic\Registracija;
use App\Models\Repositories\PrijavaRepository;
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
     * @var Registracija
     */
    private $registracija;
    private $prijava;

    public function __construct(Registracija $registracija, PrijavaRepository $prijava)
    {
        $this->registracija = $registracija;
        $this->prijava = $prijava;
    }

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
            'password.regex' => "Geslo mora vsebovati vsaj eno števko.",
            'password.min' => "Geslo mora vsebovati vsaj :min znakov.",
            'email.unique' => "Email je že v uporabi.",
            'username.unique' => "Uporabniško ime je že v uporabi.",
        ];

        $validator = Validator::make($request->all(), [
            'ime' => 'required|max:30',
            'priimek' => 'required|max:30',
            'email' => 'required|email|max:30|unique:uporabnik,email',
            'password' => 'required|min:8|regex:/^(?=.*[^a-zA-Z])/|Confirmed',
            'username' => 'required|max:30|unique:uporabnik,username',
        ], $messages);


        if(!$validator->passes()) {
            return view('auth.register')
                ->with(['errors' => $validator->errors()->all()]);

        }

        $this->registracija->createUser($request->request->all());
        $user = $this->prijava->uporabnikByEmail($request->request->get('email'));
        $user->vloga = VlogaUporabnika::KANDIDAT;
        $user->save();
        $this->sendActivationEmail($request->request->get('email'), $request->url());
        
        return view('auth.register')
            ->with(['success' => 'success']);

    }

    public function sendActivationEmail($email, $url)
    {
        Mail::send('auth.emails.registration', ['user' => $this->prijava->uporabnikByEmail($email), 'url' => $url], function ($m) use($email){
            $m->from('skrbnik@faks.me', 'Vpis v visoko šolstvo.');
            $m->to($email)->subject('Aktivacija računa');
        });
    }

    public function showActivation($zeton)
    {
        $user = $this->prijava->uporabnikByZeton($zeton);
        if (!empty($user)) {
            if ($user->created_at < date('Y-m-d H:i:s', strtotime('- 5 min'))) {
                $user->forceDelete();
                return view('auth.register')
                    ->with(['comment' => 'timeout']);
            } else {
                $user->zeton = '';
                $user->save();
                return view('auth.register')
                    ->with(['comment' => 'success']);
            }

        } else {
            return view('auth.register')
                ->with(['comment' => 'fail']);
        }

    }

}
