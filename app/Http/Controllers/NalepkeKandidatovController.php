<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 7.6.2016
 * Time: 9:08
 */

namespace App\Http\Controllers;

use App\Models\Repositories\RazvrscanjeRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Repositories\StudijskiProgramiRepository;;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class NalepkeKandidatovController extends Controller
{
    private $studijskiProgrami;
    private $razvrscanje;

    public function __construct(StudijskiProgramiRepository $sp, RazvrscanjeRepository $r)
    {
        $this->studijskiProgrami = $sp;
        $this->razvrscanje = $r;
    }

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    public function isci()
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik' || Auth::user()->vloga == 'fakulteta') {
                $fakultete = $this->studijskiProgrami->ZavodiAll();
                $programi = $this->studijskiProgrami->ProgramiAll();
                $fakulteta = 0;
                if (Auth::user()->vloga == 'fakulteta') {
                    $fakulteta = $this->razvrscanje->getIdZavodaVloga(Auth::user() -> id);
                }
                $prikaziSeznam = 0;
                return view('nalepke_kandidati', ['fakultete' => $fakultete, 'programi' => $programi, 'zavod'=>$fakulteta, 'prog' => 0, 'nac' => 0, 'zaklj' => 0])->with('prikaziSeznam', $prikaziSeznam);
            }
        }

        return redirect('prijava');
    }

    public function pridobiSeznam(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik' || Auth::user()->vloga == 'fakulteta') {
                $fakultete = $this->studijskiProgrami->ZavodiAll();
                $programi = $this->studijskiProgrami->ProgramiAll();
                $prikaziSeznam = 1;

                $nacin = '';
                $zakljucek = '';

                $id = Auth::user() -> id;
                $program = $request->request->get("program");
                if (Auth::user()->vloga == 'fakulteta') {
                    $fakulteta = $this->razvrscanje->getIdZavodaVloga($id);
                } else {
                    $fakulteta = $request->request->get("fakultete");
                }
                $prijave = null;

                //nacin studija
                if ($request->request->get("nacin_studija_kandidati") == "redni") {
                    $nacin = "Redni";
                }
                else if ($request->request->get("nacin_studija_kandidati") == "izredni") {
                    $nacin = "Izredni";
                }

                //zakljucek studija
                if ($request->request->get("zakljucek") == "splosna") {
                    $zakljucek = 2;
                }
                else if ($request->request->get("zakljucek") == "poklicna") {
                    $zakljucek = 3;
                }

                //filtriranje po fakultetah in programih
                if ($fakulteta == 0) {
                    $prijave = $this->razvrscanje->vrniVsePrijave();
                }

                if ($program == 0 && $fakulteta != 0) {
                    $prijave = collect($this->studijskiProgrami->ZavodByID($fakulteta)->prijave()->get()->pluck('prijave'));
                    $prijave = $prijave->flatten();
                }

                if ($program != 0) {
                    $prijave = $this->studijskiProgrami->ProgramByID($program)->prijave()->get();
                }

                //filtriranje po nacinu in zakljucku
                if (!empty($nacin)) {
                    $prijave = $prijave->filter(function($prijava) use ($nacin) {
                        return ($prijava->studijskiProgram->nacin_studija == $nacin);
                    });
                }
                if (!empty($zakljucek)) {
                    $prijave = $prijave->filter(function($prijava) use ($zakljucek) {
                        return ($prijava->srednjesolskaIzobrazba->id_nacina_zakljucka == $zakljucek);
                    });
                }

                //sort po priimkih
                $prijave = $prijave->sortBy(function($a) {
                    return $a->kandidat->priimek;
                });

                foreach ($request->request->all() as $name => $value) {
                    //SEZNAM
                    if (stripos($name, 'isci') !== false) {
                        return view('nalepke_kandidati', ['fakultete' => $fakultete, 'programi' => $programi, 'prijave' => $prijave, 'zavod' => $fakulteta, 'prog' => $program, 'nac' => $nacin, 'zaklj' => $zakljucek])->with('prikaziSeznam', $prikaziSeznam);
                    //IZVOZ
                    }  else if (stripos($name, 'izvozi_sprejeti') !== false) {
                        $prijave = $prijave->filter(function($prijava) {
                            return ($prijava->sprejet == 1);
                        });

                        $uniques = array();
                        foreach ($prijave as $p) {
                            $uniques[$p->id_kandidata] = $p;
                        }

                        $pdf = \App::make('dompdf.wrapper');
                        ini_set('max_execution_time', 300);
                        $pdf->loadHTML(\View::make('pdf/naslovi', ['prijave' => $uniques]));
                        return $pdf->download('naslovi.pdf');
                    } else if (stripos($name, 'izvozi') !== false){
                        $uniques = array();
                        foreach ($prijave as $p) {
                            $uniques[$p->id_kandidata] = $p;
                        }

                        $pdf = \App::make('dompdf.wrapper');
                        ini_set('max_execution_time', 300);
                        $pdf->loadHTML(\View::make('pdf/naslovi', ['prijave' => $uniques]));
                        return $pdf->download('naslovi.pdf');
                    }
                }


            }
        }

        return redirect('prijava');
    }


}
