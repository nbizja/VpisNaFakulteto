<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 7.6.2016
 * Time: 9:08
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Repositories\StudijskiProgramiRepository;;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class NalepkeKandidatovController extends Controller
{
    private $studijskiProgrami;

    public function __construct(StudijskiProgramiRepository $sp)
    {
        $this->studijskiProgrami = $sp;
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

                /*nacin: 0 (brez), 1 (redni), 2 (izredni)
                  zakljucek: 0 (brez), 1 (splosna), 2 (poklicna)
                  program: 0 (brez), idPrograma
                  fakulteta: 0(brez), idFakultete
                */
                $nacin = 0;
                $zakljucek = 0;
                $program = $request->request->get("program");
                $fakulteta = $request->request->get("fakultete");
                $prijave = null;
                $naslovi = null;

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
                            $zakljucek = 1;
                        }
                        else if ($request->request->get("zakljucek") == "poklicna") {
                            $zakljucek = 2;
                        }

                        if ($program == 0 && $fakulteta != 0) {
                            
                        }

                        if ($program != 0) {
                            $prijave = $this->studijskiProgrami->ProgramByID($program)->prijave()->get();
                        }

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
