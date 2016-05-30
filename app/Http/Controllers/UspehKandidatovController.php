<?php

namespace App\Http\Controllers;

use App\Models\Enums\NormiraneTocke;
use App\Models\Repositories\PrijavaRepository;
use App\Models\Repositories\VpisniPogojiRepository;
use App\Models\Repositories\VpisRepository;
use App\Models\Uporabnik;
use Illuminate\Support\Facades\Auth;

;

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


    public function izvozPodatkov($idKandidata) {
        if (Auth::user()->vloga == 'skrbnik') {
            $kandidat = $this->prijavaRepo->uporabnikById($idKandidata);


            $pdf = \App::make('dompdf.wrapper');
            ini_set('max_execution_time', 300);
            $pdf->loadHTML(\View::make('pdf/uspehKandidata',
                $this->ustrezanjePogojem($kandidat))->with($this->vpisRepo->pregledPrijave($kandidat)));

            return $pdf->download('uspehKandidata.pdf');

        }

        return redirect('prijava');
    }

    public function preveriPogoje($idKandidata)
    {
        if (Auth::user()->vloga == 'skrbnik') {
            $kandidat = $this->prijavaRepo->uporabnikById($idKandidata);


            return view('ustrezanjePogojem', $this->ustrezanjePogojem($kandidat))
                ->with($this->vpisRepo->pregledPrijave($kandidat));
        }


        return redirect('prijava');

    }

    public function zapisiTocke()
    {
        $this->prijavaRepo->prijavljeniKandidati()
            ->each(function($kandidat) {
                $this->ustrezanjePogojem($kandidat, true);
            });

        return redirect('razvrscanje');
    }

    public function ustrezanjePogojem(Uporabnik $kandidat, $zapisiTocke = false)
    {
        $matura = null;
        $tipMature = 0;
        $predmetiS = null;
        $predmetiP = null;
        $predmeti = null;
        if (!($kandidat->poklicnaMatura->isEmpty())) {
            $tipMature = 1;
            $matura = $kandidat->poklicnaMatura->first();

        } else if (!($kandidat->matura->isEmpty())) {
            $tipMature = 0;
            $matura = $kandidat->matura->first();

        };


        $predmetiS = $kandidat->predmetiPoklicna()->with('predmet')->get();
        $predmetiP = $kandidat->predmetiSplosna()->with('predmet')->get();
        $predmeti = $predmetiS->merge($predmetiP);

        $rezultat = array(false, false, false, 0, 0, 0);
        if ($matura != null) {
            if ($matura->opravil == 1) {
                $rezultat = $this->preveriZelje($tipMature, $predmeti, $matura, $kandidat);
            } else {
                $rezultat = array(false, false, false, 0, 0, 0);
            }
        }


        $tocke = $this->izracunajTocke($rezultat, $predmeti, $matura, $tipMature, $kandidat);

        if ($zapisiTocke) {
            $kandidat->prijave
                ->sortBy('zelja')
                ->each(function($prijava) use($tocke) {
                    $prijava->tocke = $tocke[$prijava->zelja - 1];
                    $prijava->save();
                });

        }

        return ['kandidat' => $kandidat, 'matura' => $matura,
            'tipMature' => $tipMature, 'predmeti' => $predmeti,
            'rezultat' => $rezultat, 'tocke' => $tocke];
    }

    public function preveriZelje($tipMature, $predmeti, $matura, $kandidat)
    {
        $prijave = $this->vpisRepo->pregledPrijave($kandidat)['prijave'];

        $ustreza = array(false, false, false, 0, 0, 0);

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
                    if ($ustreza[$i]) {
                        $ustreza[$i+3] = $pogoj->id;
                        break;
                    }
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

            if (!(empty($this->vpisRepo->predmetMaturaById($pogoj->id_elementa, $matura->emso)))) {
                $opravil = $this->vpisRepo->predmetMaturaById($pogoj->id_elementa, $matura->emso)->opravil;
                if (!($opravil)) {
                    return false;
                }
            }

            if (!in_array($pogoj->id_elementa, $predmetiIds)) {
                return false;
            }

            if (empty($pogoj->id_elementa2)) {
                return $this->checkDoubles($predmetiIds);
            }
            if (in_array($pogoj->id_elementa2, $predmetiIds)) {
                return $this->checkDoubles($predmetiIds);
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

    public function izracunajTocke($rezultat, $predmeti, $matura, $tipMature, $kandidat)
    {
        if ($rezultat[3] != 0) {
            $kriteriji1 = $this->vpisniPogoji->VpisniPogojByID($rezultat[3])->Kriterij;
        } else {
            $kriteriji1 = null;
        }

        if ($rezultat[4] != 0) {
            $kriteriji2 = $this->vpisniPogoji->VpisniPogojByID($rezultat[4])->Kriterij;
        } else {
            $kriteriji2 = null;
        }

        if ($rezultat[5] != 0) {
            $kriteriji3 = $this->vpisniPogoji->VpisniPogojByID($rezultat[5])->Kriterij;;
        } else {
            $kriteriji3 = null;
        }

        $vsota = [0,0,0];
        for ($i = 1; $i < 4; $i++ ) {
            $kriterij = 'kriteriji'.$i;
            if (!(is_null($$kriterij))) {
                foreach ($$kriterij as $k1) {
                    if ($k1->maturitetni_uspeh == 1) {
                        if ($tipMature == 0) {
                            $vsota[$i-1] += (NormiraneTocke::SPLOSNA_MATURA_TOCKE[$matura->ocena] * floatval($k1->utez));
                        } else {
                            $vsota[$i-1] += (NormiraneTocke::POKLICNA_MATURA_TOCKE[$matura->ocena] * floatval($k1->utez));
                        }
                    } else if ($k1->ocene_34_letnika == 1) {
                        $vsota[$i-1] += NormiraneTocke::OCENE_34_LETNIK[($matura->ocena_3_letnik + $matura->ocena_4_letnik)] * floatval($k1->utez);
                    } else if (!empty($k1->id_elementa)) {
                        if ($k1->id_elementa == 'SM') {
                            foreach ($predmeti as $p) {
                                if (substr($p->predmet->id, 0,1) == 'M') {
                                    $predmet = $p;
                                    break;
                                }
                            }
                            $vsota[$i-1] += NormiraneTocke::LESTVICA_5[$predmet->ocena] * floatval($k1->utez);
                        } else if ($k1->id_elementa == 'MAT') {
                            foreach ($predmeti as $p) {
                                if (($p->predmet->id == 'M401') || ($p->predmet->id == 'L401')) {
                                    $predmet = $p;
                                    break;
                                }
                            }
                            $ocene = $p->ocena_3_letnik + $p->ocena_4_letnik;
                            $vsota[$i-1] += NormiraneTocke::OCENE_34_LETNIK[$ocene] * floatval($k1->utez);
                        }
                        else {
                            $predmet = (substr($k1->id_elementa, 0,1) == 'M') ?
                                $this->vpisRepo->predmetMaturaById($k1->id_elementa, $kandidat->emso) :
                                $this->vpisRepo->predmetMaturaPoklicnaById($k1->id_elementa, $kandidat->emso);

                            $vsota[$i-1] += NormiraneTocke::LESTVICA_5[$predmet->ocena] *
                                floatval($k1->utez);
                        }

                    }
                }
            }
        }

        return $vsota;

    }
}