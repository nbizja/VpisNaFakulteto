<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 23.5.2016
 * Time: 11:22
 */

namespace App\Http\Controllers;

use App\Models\Repositories\VpisRepository;
use App\Models\Repositories\VpisniPogojiRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Repositories\PrijavaRepository;;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\Uporabnik;

class UspehKandidatovController extends Controller
{
    private $prijavaRepo;
    private $vpisRepo;
    private $vpisniPogoji;

    public function __construct(PrijavaRepository $pr, VpisRepository $vr, VpisniPogojiRepository $vp)
    {
        $this->prijavaRepo = $pr;
        $this->vpisRepo = $vr;
        $this->vpisniPogoji = $vp;
    }

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    public function preveriPogoje($idKandidata)
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                $kandidat = $this->prijavaRepo->uporabnikById($idKandidata);
                if (!($kandidat->poklicnaMatura->isEmpty())) {
                    $tipMature = 1;
                    $matura = $kandidat->poklicnaMatura->first();
                    $predmeti = $kandidat->predmetiPoklicna()->with('predmet')->get();
                } else if (!($kandidat->matura->isEmpty())) {
                    $tipMature = 0;
                    $matura = $kandidat->matura->first();
                    $predmeti = $kandidat->predmetiSplosna()->with('predmet')->get();
                };


                if ($matura->opravil == 1) {
                    $rezultat = $this->preveriZelje($tipMature, $predmeti, $matura, $kandidat);
                } else {
                    $rezultat = array(false, false, false);
                }



                return view('ustrezanjePogojem', ['kandidat' => $kandidat, 'matura' => $matura,
                                                  'tipMature' => $tipMature, 'predmeti' => $predmeti,
                                                  'rezultat' => $rezultat])
                    ->with($this->vpisRepo->pregledPrijave($kandidat));
            }
        }

        return redirect('prijava');

    }

    public function preveriZelje($tipMature, $predmeti, $matura, $kandidat)
    {
        $prijave = $this->vpisRepo->pregledPrijave($kandidat)['prijave'];

        $ustreza = array(false, false, false);
        $i = 0;
        foreach ($prijave as $prijava) {

            //posamezna zelja
            //najprej se omejimo na tip mature
            if ($tipMature == 0) {
                $pogoji = $this->vpisniPogoji->VpisniPogojByStudijskiProgramSplosna($prijava->id_studijskega_programa);
            } else if ($tipMature == 1) {
                $pogoji = $this->vpisniPogoji->VpisniPogojByStudijskiProgramPoklicna($prijava->id_studijskega_programa);
            }

            foreach ($pogoji as $pogoj) {
                $ustreza[$i] = $this->preveriPogoj($pogoj, $predmeti, $matura);
                if ($ustreza[$i])
                    break;
            }

            $i++;
        }

        return $ustreza;
    }

    public function preveriPogoj($pogoj, $predmeti, $matura)
    {
        $predmetiIds = $predmeti->map(function($predmet) {
            return $predmet->predmet->id;
        })->toArray();


        if (!empty($pogoj->id_poklica)) {
            if ($pogoj->id_poklica != $matura->id_poklica) {  // poklic se sklada
                return false;
            }
            if (empty($pogoj->id_elementa)) {
                return false;
            }

            if (!in_array($pogoj->id_elementa, $predmetiIds)) {  //poklic + 1.element se skladata
                return false;
            }

            if (empty($pogoj->id_elementa2)) {
                return true;
            }

            if (in_array($pogoj->id_elementa2, $predmetiIds)) {
                return true;
            }

            if ($pogoj->id_elementa2 != 'SM') {
                return false;
            }

            if (!empty(array_filter($predmetiIds, function($id) {
                return substr($id, 0, 1) == 'M';
            }))) {
                return $this->checkDoubles($predmetiIds);
            }
            return false;

        } else if (!empty($pogoj->id_elementa)) {  //poklic je empty
            if (!in_array($pogoj->id_elementa, $predmetiIds)) {
                return false;
            }

            if (empty($pogoj->id_elementa2)) {
                return true;
            }
            if (in_array($pogoj->id_elementa2, $predmetiIds)) {
                return true;
            }

            if ($pogoj->id_elementa2 != 'SM') {
                return false;
            }
            if (!empty(array_filter($predmetiIds, function($id) {
                return substr($id, 0, 1) == 'M';
            }))) {
                return $this->checkDoubles($predmetiIds);
            }
            return false;
        }

        return true;
    }

    // Vrne false, ce ima tabela podvojene predmete pri poklicni in splosni maturi.
    // Drugace pa vrne true.
    public function checkDoubles($predmetIds)
    {
        $i = 0;
        $ids = [];
        foreach ($predmetIds as $id)
        {
            $ids[$i] = substr($id, 1, 3);
            $i++;
        }
        return count(array_unique($ids)) == count($predmetIds);
    }
}