<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 15.4.2016
 * Time: 10:56
 */


namespace App\Http\Controllers\StudijskiProgrami;

use Illuminate\Support\Facades\Auth;
use App\Models\Repositories\StudijskiProgramiRepository;;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;


class SeznamController extends Controller
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

    public function seznamProgramov(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {

                if ($request->query->has('nacin')) {
                    if ($request->query->get('nacin') == "redni") {
                        $programi = $this->studijskiProgrami->ProgramiRedni()->sortBy('visokosolskiZavod.ime');
                    } else {
                        $programi = $this->studijskiProgrami->ProgramiIzredni()->sortBy('visokosolskiZavod.ime');
                    }
                    return view('studijskiProgrami.seznamProgramov', ['programi' => $programi]);

                } else if ($request->query->has('vrsta')) {
                    if ($request->query->get('vrsta') == "vs") {
                        $programi = $this->studijskiProgrami->ProgramiVs()->sortBy('visokosolskiZavod.ime');
                    } else {
                        $programi = $this->studijskiProgrami->ProgramiUn()->sortBy('visokosolskiZavod.ime');
                    }
                    return view('studijskiProgrami.seznamProgramov', ['programi' => $programi]);

                } else if ($request->query->has('omejitev')) {
                    if ($request->query->get('omejitev') == "da") {
                        $programi = $this->studijskiProgrami->ProgramiOmejitev()->sortBy('visokosolskiZavod.ime');
                    } else {
                        $programi = $this->studijskiProgrami->ProgramiBrezOmejitve()->sortBy('visokosolskiZavod.ime');
                    }
                    return view('studijskiProgrami.seznamProgramov', ['programi' => $programi]);
                }

                $programi = $this->studijskiProgrami->ProgramiAll()->sortBy('visokosolskiZavod.ime');
                return view('studijskiProgrami.seznamProgramov', ['programi' => $programi]);
            }
        }

        return redirect('prijava');
    }

    public function izvozi(Request $request)
    {

        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {

                if ($request->query->has('nacin')) {
                    if ($request->query->get('nacin') == "redni") {
                        $programi = $this->studijskiProgrami->ProgramiRedni()->sortBy('visokosolskiZavod.ime');
                    } else {
                        $programi = $this->studijskiProgrami->ProgramiIzredni()->sortBy('visokosolskiZavod.ime');
                    }

                } else if ($request->query->has('vrsta')) {
                    if ($request->query->get('vrsta') == "vs") {
                        $programi = $this->studijskiProgrami->ProgramiVs()->sortBy('visokosolskiZavod.ime');
                    } else {
                        $programi = $this->studijskiProgrami->ProgramiUn()->sortBy('visokosolskiZavod.ime');
                    }

                } else if ($request->query->has('omejitev')) {
                    if ($request->query->get('omejitev') == "da") {
                        $programi = $this->studijskiProgrami->ProgramiOmejitev()->sortBy('visokosolskiZavod.ime');
                    } else {
                        $programi = $this->studijskiProgrami->ProgramiBrezOmejitve()->sortBy('visokosolskiZavod.ime');
                    }
                }
                $programi = $this->studijskiProgrami->ProgramiAll()->sortBy('visokosolskiZavod.ime');

                $pdf = \App::make('dompdf.wrapper');
                ini_set('max_execution_time', 300);

                $pdf->loadHTML(\View::make('pdf/seznamProgramov')->with('programi', $programi));

                return $pdf->download('studijskiProgrami.pdf');

            }
        }

        return redirect('prijava');
    }

}
