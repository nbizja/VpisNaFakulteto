<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 10.4.2016
 * Time: 9:08
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

class StudijskiProgramiController extends Controller
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


    public function urediPrograme()
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                $fakultete = $this->studijskiProgrami->ZavodiAll();
                $programi = $this->studijskiProgrami->ProgramiAll();
                return view('studijskiProgrami.vzdrzevanjeProgramov', ['fakultete' => $fakultete, 'programi' => $programi]);
            }
        }

        return redirect('prijava');
    }

    public function shraniPrograme(Request $request)
    {
        $program =  $this->studijskiProgrami->ProgramByID($request->request->get('program'));

        if($request->request->has('shrani')) {
            $program->stevilo_vpisnih_mest = $request->request->get('stevilo_mest');
            $program->stevilo_mest_po_omejitvi = $request->request->get('stevilo_mest_omejitev');


            if ($request->request->get('vrsta_studija') == 'un') {
                $vrsta = 'Univerzitetni';
            } else {
                $vrsta = 'Visokošolski strokovni';
            }

            if ($request->request->get('nacin_studija') == 'izredni') {
                $nacin = 'Izredni';
            } else {
                $nacin = 'Redni';
            }

            if ($request->request->get('omejitev') == 'da') {
                $omejitev = '1';
            } else {
                $omejitev = '0';
            }

            $program->nacin_studija = $nacin;
            $program->vrsta = $vrsta;
            $program->omejitev_vpisa = $omejitev;

            $program->save();
        } else {
            $program->forceDelete();
        }

        $programi = $this->studijskiProgrami->ProgramiAll()->sortBy('visokosolskiZavod.ime');
        return redirect('studijskiProgrami/seznam')->with('programi',  $programi);
    }

    public function novProgram()
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                $fakultete = $this->studijskiProgrami->ZavodiAll();
                return view('studijskiProgrami.dodajProgram', ['fakultete' => $fakultete]);
            }
        }

        return redirect('prijava');
    }


    public function dodajProgram(Request $request)
    {

        $messages = [
            'required' => "Zahtevana je izpolnjenost šifre in naziva.",
            'numeric' => "Neveljaven vnos.",
        ];

        $validator = Validator::make($request->all(), [
            'naziv' => 'required',
            'sifra' => 'required',
            'stevilo_mest' => 'numeric',
            'stevilo_mest_omejitev' => 'numeric'
        ], $messages);


        if(!$validator->passes()) {
            $fakultete = $this->studijskiProgrami->ZavodiAll();
            return view('studijskiProgrami.dodajProgram', ['fakultete' => $fakultete])
                ->with(['failure' => $validator->errors()->all()]);

        } else {
            if ($request->request->get('vrsta_studija') == 'un') {
                $vrsta = 'Univerzitetni';
            } else {
                $vrsta = 'Visokošolski strokovni';
            }

            if ($request->request->get('nacin_studija') == 'izredni') {
                $nacin = 'Izredni';
            } else {
                $nacin = 'Redni';
            }

            if ($request->request->get('omejitev') == 'da') {
                $omejitev = '1';
            } else {
                $omejitev = '0';
            }

            StudijskiProgram::create([
                'id_zavoda' => $request->request->get('fakulteta'),
                'sifra' => $request->request->get('sifra'),
                'ime' => $request->request->get('naziv'),
                'nacin_studija' => $nacin,
                'vrsta' => $vrsta,
                'omejitev_vpisa' => $omejitev,
                'stevilo_vpisnih_mest' => $request->request->get('stevilo_mest'),
                'stevilo_mest_po_omejitvi' => $request->request->get('stevilo_mest_omejitev'),
            ]);

            $programi = $this->studijskiProgrami->ProgramiAll()->sortBy('visokosolskiZavod.ime');
            return redirect('studijskiProgrami/seznam')->with('programi',  $programi);
        }
    }

    public function izpisPodatkov()
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                $fakultete = $this->studijskiProgrami->ZavodiAll();
                $programi = $this->studijskiProgrami->ProgramiAll();
                return view('studijskiProgrami.izpisPodatkov', ['fakultete' => $fakultete, 'programi' => $programi]);
            }
        }

        return redirect('prijava');
    }
}
