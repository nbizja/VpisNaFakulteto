<?php

namespace App\Http\Controllers;

use App\Models\Logic\Validators;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
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
}