<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 10.4.2016
 * Time: 9:08
 */

namespace App\Http\Controllers\Matura;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PoklicnaMaturaController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';


    public function uvoziPodatke()
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                return view('matura/uvoziPodatkeOPoklicniMaturi');
            }
        }

        return redirect('prijava');
    }

}
