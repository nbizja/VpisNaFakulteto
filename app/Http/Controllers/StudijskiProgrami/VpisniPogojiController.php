<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 7.5.2016
 * Time: 12:07
 */

namespace App\Http\Controllers\StudijskiProgrami;

use Illuminate\Support\Facades\Auth;
use App\Models\Repositories\StudijskiProgramiRepository;;
use App\Models\StudijskiProgram;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class VpisniPogojiController extends Controller
{
    private $studijskiProgrami;

    public function __construct(StudijskiProgramiRepository $sp)
    {
        $this->studijskiProgrami = $sp;
    }

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function urediPogoje()
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                $fakultete = $this->studijskiProgrami->ZavodiAll();
                $programi = $this->studijskiProgrami->ProgramiAll();
                return view('studijskiProgrami.urejanjePogojev', ['fakultete' => $fakultete, 'programi' => $programi]);
            }
        }

        return redirect('prijava');
    }

    public function shraniPogoje(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {

                foreach ($request->request->all() as $name => $value) {
                    if (stripos($name,'uredi') !== false) {
                        $program = $this->studijskiProgrami->ProgramByID($request->request->get('program'));
                        return view('studijskiProgrami.urediPogoj', ['program' => $program,'id_pogoja'=> substr($name, 5, strlen($name)-5)]);
                    }
                }
            }
        }

        //return redirect('prijava');
    }
}
