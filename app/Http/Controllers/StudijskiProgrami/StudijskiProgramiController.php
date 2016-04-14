<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 10.4.2016
 * Time: 9:08
 */

namespace App\Http\Controllers\StudijskiProgrami;

use App\Models\Enums\VrstaStudija;
use Illuminate\Support\Facades\Auth;
use App\Models\Enums\NacinStudija;
use App\Models\Repositories\StudijskiProgramiRepository;;
use App\Models\StudijskiProgram;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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

    public function seznamProgramov()
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                $programi = $this->studijskiProgrami->ProgramiAll()->sortBy('visokosolskiZavod.ime');
                return view('studijskiProgrami.seznamProgramov', ['programi' => $programi]);
            }
        }

        return redirect('prijava');
    }

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
            $program->nacin_studija = $request->request->get('nacin_studija');
            $program->vrsta = $request->request->get('vrsta_studija');
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

        StudijskiProgram::create([
            'id_zavoda' => $request->request->get('fakulteta'),
            'sifra' => $request->request->get('sifra'),
            'ime' => $request->request->get('naziv'),
            'nacin_studija' => $nacin,
            'vrsta' => $vrsta,
            'stevilo_vpisnih_mest' => $request->request->get('stevilo_mest'),
            'stevilo_mest_po_omejitvi' => $request->request->get('stevilo_mest_omejitev'),
        ]);

        $programi = $this->studijskiProgrami->ProgramiAll()->sortBy('visokosolskiZavod.ime');
        return redirect('studijskiProgrami/seznam')->with('programi',  $programi);
    }

}
