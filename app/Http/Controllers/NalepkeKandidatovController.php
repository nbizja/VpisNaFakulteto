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
            if (Auth::user()->vloga == 'skrbnik') {
                $fakultete = $this->studijskiProgrami->ZavodiAll();
                $programi = $this->studijskiProgrami->ProgramiAll();
                $prikaziSeznam = 0;
                return view('nalepke_kandidati', ['fakultete' => $fakultete, 'programi' => $programi])->with('prikaziSeznam', $prikaziSeznam);
            }
        }

        return redirect('prijava');
    }

    public function pridobiSeznam(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                $fakultete = $this->studijskiProgrami->ZavodiAll();
                $programi = $this->studijskiProgrami->ProgramiAll();
                $prikaziSeznam = 1;

                $nacin = '';
                $zakljucek = '';
                $program = $request->request->get("program");
                $fakulteta = $request->request->get("fakultete");
                $prijave = null;

                foreach ($request->request->all() as $name => $value) {
                    if (stripos($name, 'isci') !== false) {

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
                            $prijave = $this->studijskiProgrami->ZavodByID($fakulteta)->prijave()->get()->pluck('prijave');
                            $prijave = array_flatten($prijave);
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

                        dd($prijave);
                        /*                $obravnavanePrijave = $program->prijave
                    ->filter(function($prijava) {
                        return $prijava->zelja == $this->obravnava['K'. $prijava->id_kandidata];
                    })
                    ->values(); //Reset array keys*/
                       /* foreach ($prijave as $prijava) {
                            if ($prijava)
                            dd ($prijava->kandidat->naslovZaPosiljanje()->first());
                        }*/

//'naslovZaPosiljanje' => $uporabnik->naslovZaPosiljanje()->with('obcina', 'posta', 'drzava')->first(),
                    } else {
                        //izvoz
                    }
                }

                return view('nalepke_kandidati', ['fakultete' => $fakultete, 'programi' => $programi, 'prijave' => $prijave])->with('prikaziSeznam', $prikaziSeznam);
            }
        }

        return redirect('prijava');
    }


}
