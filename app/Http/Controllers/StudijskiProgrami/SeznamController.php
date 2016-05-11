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
                } else {
                    $programi = $this->studijskiProgrami->ProgramiAll()->sortBy('visokosolskiZavod.ime');
                }

                return view('studijskiProgrami.seznamProgramov', ['programi' => $programi, 'query' => $request->query->all()]);
            }
        }

        return redirect('prijava');
    }

    public function izvozi(Request $request)
    {

        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {

                if ($request->request->has('nacin')) {
                    if ($request->request->get('nacin') == "redni") {
                        $programi = $this->studijskiProgrami->ProgramiRedni()->sortBy('visokosolskiZavod.ime');
                    } else {
                        $programi = $this->studijskiProgrami->ProgramiIzredni()->sortBy('visokosolskiZavod.ime');
                    }

                } else if ($request->request->has('vrsta')) {
                    if ($request->request->get('vrsta') == "vs") {
                        $programi = $this->studijskiProgrami->ProgramiVs()->sortBy('visokosolskiZavod.ime');
                    } else {
                        $programi = $this->studijskiProgrami->ProgramiUn()->sortBy('visokosolskiZavod.ime');
                    }

                } else if ($request->request->has('omejitev')) {
                    if ($request->request->get('omejitev') == "da") {
                        $programi = $this->studijskiProgrami->ProgramiOmejitev()->sortBy('visokosolskiZavod.ime');
                    } else {
                        $programi = $this->studijskiProgrami->ProgramiBrezOmejitve()->sortBy('visokosolskiZavod.ime');
                    }
                } else {
                    $programi = $this->studijskiProgrami->ProgramiAll()->sortBy('visokosolskiZavod.ime');
                }

                $search = mb_convert_case($request->request->get('search', ''), MB_CASE_UPPER, "UTF-8");
                if (!empty($search)) {
                    $prog = $programi->filter(function($p) use ($search) {

                        return (stripos($p->ime, $search) !== false) ||
                        (stripos($p->sifra, $search) !== false) ||
                        (stripos($p->nacin_studija, $search) !== false) ||
                        (stripos($p->vrsta, $search) !== false) ||
                        (stripos($p->visokosolskiZavod->ime, $search) !== false);
                    });
                    $prog->sortBy('visokosolskiZavod.ime');
                }

                $sifra=false;
                $zavod=false;
                $nacin=false;
                $vrsta=false;
                $stevilo=false;
                $steviloO=false;
                $steviloS=false;
                $omejitev=false;
                $steviloT=false;
                $steviloOT=false;
                $steviloST=false;
                $omejitevT=false;

                if ($request->request->has('sifraC')) {
                    $sifra=true;
                };
                if ($request->request->has('zavodC')) {
                    $zavod=true;
                };
                if ($request->request->has('nacinC')) {
                    $nacin=true;
                };
                if ($request->request->has('vrstaC')) {
                    $vrsta=true;
                };
                if ($request->request->has('steviloC')) {
                    $stevilo=true;
                };
                if ($request->request->has('steviloCO')) {
                    $steviloO=true;
                };
                if ($request->request->has('steviloCS')) {
                    $steviloS=true;
                };
                if ($request->request->has('omejitevC')) {
                    $omejitev=true;
                };
                if ($request->request->has('steviloCT')) {
                    $steviloT=true;
                };
                if ($request->request->has('steviloCOT')) {
                    $steviloOT=true;
                };
                if ($request->request->has('steviloCST')) {
                    $steviloST=true;
                };
                if ($request->request->has('omejitevCT')) {
                    $omejitevT=true;
                };


                $pdf = \App::make('dompdf.wrapper');
                ini_set('max_execution_time', 300);

                $pdf->loadHTML(\View::make('pdf/seznamProgramov')->with('programi', $prog)
                ->with('sifra', $sifra)->with('zavod', $zavod)->with('nacin', $nacin)->with('vrsta',$vrsta)
                ->with('steviloT', $steviloT)->with('steviloOT', $steviloOT)->with('steviloST', $steviloST)->with('omejitevT', $omejitevT)
                ->with('stevilo', $stevilo)->with('steviloO', $steviloO)->with('steviloS', $steviloS)->with('omejitev', $omejitev));

                return $pdf->download('studijskiProgrami.pdf');

            }
        }

        return redirect('prijava');
    }

}
