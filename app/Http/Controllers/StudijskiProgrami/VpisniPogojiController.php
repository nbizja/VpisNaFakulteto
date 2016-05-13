<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 7.5.2016
 * Time: 12:07
 */

namespace App\Http\Controllers\StudijskiProgrami;

use Illuminate\Support\Facades\Auth;
use App\Models\Repositories\StudijskiProgramiRepository;
use App\Models\Repositories\VpisniPogojiRepository;;
use App\Models\StudijskiProgram;
use App\Models\VpisniPogoj;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class VpisniPogojiController extends Controller
{
    private $studijskiProgrami;
    private $vpisniPogoji;

    public function __construct(StudijskiProgramiRepository $sp, VpisniPogojiRepository $vp)
    {
        $this->studijskiProgrami = $sp;
        $this->vpisniPogoji = $vp;
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

    // pritisk na izbrisi, dodaj ali uredi
    public function urediPogoj(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                $program = $this->studijskiProgrami->ProgramByID($request->request->get('program'));
                foreach ($request->request->all() as $name => $value) {
                    if (stripos($name,'uredi') !== false) {
                        $elementi = $this->vpisniPogoji->ElementiAll();
                        $poklici = $this->vpisniPogoji->PokliciAll();
                        $pogoj = $this->vpisniPogoji->VpisniPogojByID(substr($name, 5, strlen($name)-5));
                        return view('studijskiProgrami.urediPogoj', ['poklici' => $poklici, 'elementi' => $elementi, 'program' => $program,'pogoj'=> $pogoj]);
                    }if (stripos($name,'delez') !== false) {
                        $elementi = $this->vpisniPogoji->ElementiAll();
                        $poklici = $this->vpisniPogoji->PokliciAll();
                        $pogoj = $this->vpisniPogoji->VpisniPogojByID(substr($name, 5, strlen($name)-5));
                        return view('studijskiProgrami.urediDeleze', ['poklici' => $poklici, 'elementi' => $elementi, 'program' => $program,'pogoj'=> $pogoj]);
                    }else if (stripos($name,'brisi') !== false) {
                        $pogoj = $this->vpisniPogoji->VpisniPogojByID(substr($name, 5, strlen($name)-5));
                        $pogoj->forceDelete();
                        return $this->urediPogoje();
                    } else if ($name == 'dodajPogoj') {
                        return $this->dodajPogoj($program->id);
                    }
                }
            }
        }

        return redirect('prijava');
    }

    public function shraniPogoj(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                $pogoj =  $this->vpisniPogoji->VpisniPogojByID($request->request->get('pogoj'));

                if ($request->request->get('element1') == 'poklicna_matura') {
                    $pogoj->splosna_matura = 0;
                    $pogoj->poklicna_matura = 1;
                } else if ($request->request->get('element1') == 'splosna_matura') {
                    $pogoj->splosna_matura = 1;
                    $pogoj->poklicna_matura = 0;
                } else if ($request>$request->get('element1') != '') {
                    $pogoj->splosna_matura = 0;
                    $pogoj->poklicna_matura = 0;
                    $pogoj->id_poklica = $request>$request->get('element1');
                }

                if($request->request->get('element2') != 'prazno') {
                    $pogoj->id_elementa = $request->request->get('element2');
                } else {
                    $pogoj->id_elementa = '';
                }

                if($request->request->get('element3') != 'prazno') {
                    $pogoj->id_elementa2 = $request->request->get('element3');
                } else {
                    $pogoj->id_elementa2 = '';
                }

                $pogoj->save();

                return $this->urediPogoje();
            }
        }

        return redirect('prijava');
    }

    public function shraniDeleze(Request $request)
    {
        if (Auth::check()) {

        }

        return redirect('prijava');
    }

    public function dodajPogoj($id)
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                $elementi = $this->vpisniPogoji->ElementiAll();
                $program = $this->studijskiProgrami->ProgramByID($id);
                $poklici = $this->vpisniPogoji->PokliciAll();
                return view('studijskiProgrami.dodajPogoj', ['poklici' => $poklici, 'program' => $program, 'elementi' => $elementi]);
            }
        }

        return redirect('prijava');
    }

    public function novPogoj(Request $request) {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                $poklicna_matura = 0;
                $splosna_matura = 0;
                $poklic = '';
                if ($request->request->get('element1') == 'poklicna_matura') {
                    $poklicna_matura = 1;
                } else if ($request->request->get('element1') == 'splosna_matura') {
                    $splosna_matura = 1;
                } else if ($request>$request->get('element1') != '') {
                    $poklic = $request->request->get('element1');
                }

                $element = '';
                if($request->request->get('element2') != 'prazno') {
                    $element = $request->request->get('element2');
                }

                $element2 = '';
                if($request->request->get('element3') != 'prazno') {
                    $element2 = $request->request->get('element3');
                }

                VpisniPogoj::create([
                    'id_programa' => $request->request->get('program'),
                    'id_elementa' => $element,
                    'id_elementa2' => $element2,
                    'vnos_veljaven' => 1,
                    'splosna_matura' => $splosna_matura,
                    'poklicna_matura' => $poklicna_matura,
                    'id_poklica' => $poklic
                ]);

                return $this->urediPogoje();
            }
        }

        return redirect('prijava');
    }
}
