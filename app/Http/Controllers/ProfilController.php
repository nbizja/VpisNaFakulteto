<?php

namespace App\Http\Controllers;

use App\Models\Logic\Validators;
use App\Models\PozabljenoGeslo;
use App\Models\Repositories\PrijavaRepository;
use App\Models\Uporabnik;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    /**
     * @var PrijavaRepository
     */
    private $prijavaRepository;

    public function __construct(PrijavaRepository $prijavaRepository)
    {
        $this->prijavaRepository = $prijavaRepository;
    }

    public function index()
    {
        return view('profil');
    }
    
    public function ponastaviGeslo(Request $request)
    {
        $errors = [];
        $uporabnik = Auth::user();
        if (!password_verify($request->request->get('old-password'), $uporabnik->password)) {
            $errors[] = 'Napačno trenutno geslo';
        }

        if ($request->request->get('new-password') != $request->request->get('password-confirmation')) {
            $errors[] = 'Gesli se ne ujemata';
        }
        $validator = Validator::make($request->request->all(), [
            'new-password' => Validators::PASSWORD,
        ], Validators::passwordMessage('new-password'));
        
        
        if (!$validator->passes()) {
            $errors = array_merge($errors, $validator->errors()->all());
        }

        if (!empty($errors)) {
            return redirect('geslo')
                ->withInput()
                ->with('errors', $errors);
        }

        $uporabnik->password = Hash::make($request->request->get('new-password'));
        $uporabnik->save();

        return redirect('geslo')->with('success', 'success');
    }

    public function pozabljenoGeslo()
    {
        return view('auth.passwords.pozabljeno_geslo');
    }

    public function posljiGeslo(Request $request)
    {
        $errors = [];

        if ($request->request->get('new-password') != $request->request->get('password-confirmation')) {
            $errors[] = 'Gesli se ne ujemata';
        }
        $validator = Validator::make($request->request->all(), [
            'new-password' => Validators::PASSWORD,
        ], Validators::passwordMessage('new-password'));
        

        if (!$validator->passes()) {
            $errors = array_merge($errors, $validator->errors()->all());
        }

        $uporabnik = $this->prijavaRepository->uporabnikByEmailAndUsername($request->request->get('email'), $request->request->get('username'));

        if (empty($uporabnik)) {
            $errors[] = 'Uporabnik s tem emailom in uporabniškim geslom ne obstaja.';
        }

        if (!empty($errors)) {
            return redirect('pozabljeno_geslo')
                ->withInput()
                ->with('errors', $errors);
        }
        
        $pozabljenoGeslo = PozabljenoGeslo::create([
            'id_uporabnika' => $uporabnik->id,
            'novo_geslo'    => password_hash($request->request->get('new-password'), PASSWORD_BCRYPT),
            'zeton'         => str_random(32),
            'veljavnost'    => date('Y-m-d H:i:s', strtotime('+ 1 day'))
        ]);

        $potrditenaPovezava = url('pozabljeno_geslo', $pozabljenoGeslo->zeton);

        Mail::send('auth.emails.pozabljeno_geslo', ['user' => $uporabnik, 'url' => $potrditenaPovezava], function ($m) use($uporabnik){
            $m->from('skrbnik@faks.me', 'Vpis v visoko šolstvo.');
            $m->to($uporabnik->email)->subject('Pozabljeno geslo');
        });


        return redirect('pozabljeno_geslo')->with('success', 'success');
    }

    public function potrditevMenjave($zeton)
    {
        $pozabljenoGeslo = PozabljenoGeslo::where('zeton', $zeton)->first();

        if (empty($pozabljenoGeslo)) {
            return redirect('pozabljeno_geslo')->with('errors', [
                'Neveljaven žeton!'
            ]);
        }

        if ($pozabljenoGeslo->veljavnost < date('Y-m-d H:i:s')) {
            return redirect('pozabljeno_geslo')->with('errors', [
                'Veljavnost žetona je potekla!'
            ]);
        }

        $uporabnik = Uporabnik::find($pozabljenoGeslo->id_uporabnika);

        $uporabnik->password = $pozabljenoGeslo->novo_geslo;
        $uporabnik->save();

        $pozabljenoGeslo->novo_geslo = '';
        $pozabljenoGeslo->zeton = '';
        $pozabljenoGeslo->veljavnost = date('Y-m-d H:i:s');
        $pozabljenoGeslo->save();

        return redirect('prijava')
            ->with('status', 'success')
            ->with('message', 'Prijavite se lahko z novim geslom');
    }

}