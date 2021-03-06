<?php

namespace App\Http\Controllers;

use App\Models\Element;
use App\Models\Matura;
use App\Models\PoklicnaMatura;
use App\Models\KoncanaSrednjaSola;
use App\Models\MaturaPredmet;
use App\Models\PoklicnaMaturaPredmet;
use App\Models\PrijavaSrednjesolskaIzobrazba;
use App\Models\StudijskiProgram;
use App\Models\Uporabnik;
use App\Models\VisokosolskiZavod;
use Illuminate\Http\Request;
use App\Models\Enums\VlogaUporabnika;
use Illuminate\Support\Facades\Auth;

class ListOfCandidatesController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function getNumberZavod($id)
    {
        $zavodi = VisokosolskiZavod::orderBy('ime')->pluck('id');
        foreach ($zavodi as $i => $zavod){
            if($zavod == $id) return $i;
        }

        return -1;
    }

    public function urediPodatke(Request $request)
    {
        $all = $request->all();
        foreach ($all as $key => $i) {
            if(stripos($key,'uredi') !== false) {
                $id_kandidata = substr($key, 5, strlen($key)-5);
            }
        }

        $kandidat = Uporabnik::find($id_kandidata);
        $predmeti_uspeh = MaturaPredmet::where('emso', '=', $kandidat->emso)->get();
        $predmeti_uspeh = $predmeti_uspeh->merge(PoklicnaMaturaPredmet::where('emso', '=', $kandidat->emso)->get());

        if(!(Matura::where('emso', '=', $kandidat->emso)->exists() || PoklicnaMatura::where('emso', '=', $kandidat->emso)->exists())){

            $tocke = 0;
            if(count($predmeti_uspeh) > 0){
                foreach($predmeti as $predmet){
                    $tocke += $predmet->ocena;
                }
            }

            $matura = new Matura();
            $matura->emso = $kandidat->emso;
            $matura->ocena = $tocke;
            $matura->ocena_3_letnik = 1;
            $matura->ocena_4_letnik = 1;
            $matura->save();
        }

        $matura = Matura::where('emso', '=', $kandidat->emso)->get();
        $matura = $matura->merge(PoklicnaMatura::where('emso', '=', $kandidat->emso)->get())[0];

        foreach($predmeti_uspeh as $p) {
            $p->ime_predmeta = Element::where('id', '=', $p->id_predmeta)->pluck('ime')[0];
        }

        return view('urediPodatkeUspeh')
            ->with([
                'kandidat' => $kandidat,
                'predmeti' => $predmeti_uspeh,
                'matura' => $matura,
                'sporocilo' => ''
            ]);
    }

    public function shraniPodatke(Request $request)
    {
        if (Auth::check()) {

            $id_kandidata = -1;
            $all = $request->all();
            foreach ($all as $key => $i) {
                if(stripos($key, 'shrani') !== false) {
                    $id_kandidata = substr($key, 6, strlen($key)-6);
                }
            }

            $kandidat = Uporabnik::find($id_kandidata);
            $emso = $kandidat->emso;
            $vsota = 0;
            $matura_ocena = 0;
            $isValid = true;
            $matura = Matura::where('emso', '=', $emso)->get();
            $matura = $matura->merge(PoklicnaMatura::where('emso', '=', $emso)->get())[0];

            if(Matura::where('emso', '=', $emso)->exists()) $tip_mature = 0;
            else $tip_mature = 1;

            foreach ($all as $key => $i) {
                if((stripos($key,'o3') !== false) || (stripos($key,'o4') !== false) || ($key == 'ocena3letnik') || $key == 'ocena4letnik'){
                    if($i > 5 || $i < 1) $isValid = false;
                }
                else if($key == 'maturatocke'){
                    $matura_ocena = $i;
                }
                else if (stripos($key,'om') !== false) {
                    $id_predmeta = substr($key, 2, strlen($key)-2);
                    $predmet = Element::where('id', '=', $id_predmeta)->first();

                    if(stripos($predmet->ime,'VIŠJA') || ($predmet->ime == "SLOVENSKI JEZIK IN KNJIŽEVNOST (NA MATURI)")){
                        if($i > 8 || $i < 1) $isValid = false;
                    }
                    else if($i > 5 || $i < 1) $isValid = false;
                }
            }

            if($isValid) {

                foreach ($all as $key => $i) {
                    if (stripos($key, 'o3') !== false) {
                        $id_predmeta = substr($key, 2, strlen($key) - 2);
                        if ($tip_mature == 0) {
                            MaturaPredmet::where('emso', '=', $emso)->where('id_predmeta', '=', $id_predmeta)->update(array('ocena_3_letnik' => $i));
                        } else {
                            PoklicnaMaturaPredmet::where('emso', '=', $emso)->where('id_predmeta', '=', $id_predmeta)->update(array('ocena_3_letnik' => $i));
                        }
                    } else if (stripos($key, 'o4') !== false) {
                        $id_predmeta = substr($key, 2, strlen($key) - 2);
                        if ($tip_mature == 0) {
                            MaturaPredmet::where('emso', '=', $emso)->where('id_predmeta', '=', $id_predmeta)->update(array('ocena_4_letnik' => $i));
                        } else {
                            PoklicnaMaturaPredmet::where('emso', '=', $emso)->where('id_predmeta', '=', $id_predmeta)->update(array('ocena_4_letnik' => $i));
                        }
                    } else if (stripos($key, 'om') !== false) {
                        $id_predmeta = substr($key, 2, strlen($key) - 2);
                        if ($tip_mature == 0) {
                            MaturaPredmet::where('emso', '=', $emso)->where('id_predmeta', '=', $id_predmeta)->update(array('ocena' => $i));
                        } else {
                            PoklicnaMaturaPredmet::where('emso', '=', $emso)->where('id_predmeta', '=', $id_predmeta)->update(array('ocena' => $i));
                        }
                        $vsota += $i;
                    } else if ($key == 'ocena3letnik') {
                        if ($tip_mature == 0) Matura::where('emso', '=', $emso)->update(array('ocena_3_letnik' => $i));
                        else PoklicnaMatura::where('emso', '=', $emso)->update(array('ocena_3_letnik' => $i));
                    } else if ($key == 'ocena4letnik') {
                        if ($tip_mature == 0) Matura::where('emso', '=', $emso)->update(array('ocena_4_letnik' => $i));
                        else PoklicnaMatura::where('emso', '=', $emso)->update(array('ocena_4_letnik' => $i));
                    }
                }

                if($matura->ocena == $matura_ocena && $vsota > 0){
                    if ($tip_mature == 0) Matura::where('emso', '=', $emso)->update(array('ocena' => $vsota));
                    else PoklicnaMatura::where('emso', '=', $emso)->update(array('ocena' => $vsota));
                }
                else {
                    if ($matura_ocena >= 0 && $matura_ocena <= 34){
                        if ($tip_mature == 0) Matura::where('emso', '=', $emso)->update(array('ocena' => $matura_ocena));
                        else PoklicnaMatura::where('emso', '=', $emso)->update(array('ocena' => $matura_ocena));
                    }
                    else {
                        $isValid = false;
                    }
                }

            }

            if($isValid) $sporocilo = "Podatki so bili uspešno shranjeni!";
            else $sporocilo = "Ocene morajo biti znotraj predpisanih mej!";

            $predmeti_uspeh = MaturaPredmet::where('emso', '=', $emso)->get();
            $predmeti_uspeh = $predmeti_uspeh->merge(PoklicnaMaturaPredmet::where('emso', '=', $emso)->get());

            $matura = Matura::where('emso', '=', $emso)->get();
            $matura = $matura->merge(PoklicnaMatura::where('emso', '=', $emso)->get())[0];

            foreach ($predmeti_uspeh as $p) {
                $p->ime_predmeta = Element::where('id', '=', $p->id_predmeta)->pluck('ime')[0];
            }

            return view('urediPodatkeUspeh')
                ->with([
                    'kandidat' => $kandidat,
                    'predmeti' => $predmeti_uspeh,
                    'matura' => $matura,
                    'sporocilo' => $sporocilo
                ]);

        }
        return redirect('prijava');
    }

    public function loadPage()
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                return view('list_candidates')
                    ->with([
                        'vz' => VisokosolskiZavod::orderBy('ime')->pluck('ime'),
                        'zavod_id' => -1,
                        'program_id' => -1,
                        'nacin' => -1,
                        'srednja' => -1,
                        'talent' => -1,
                        'koncana_srednja' => KoncanaSrednjaSola::pluck('ime'),
                        'idz' => -1
                    ]);
            }

            else if (Auth::user()->vloga == 'fakulteta') {
                $id = Auth::user() -> id;
                $idp = VisokosolskiZavod::where('id_skrbnika', '=', $id)->orderBy('ime')->pluck('id')->first();
                $id_prog = $this->getNumberZavod($idp);
                return view('list_candidates')
                    ->with([
                        'vz' => VisokosolskiZavod::where('id_skrbnika', '=', $id)->orderBy('ime')->pluck('ime'),
                        'zavod_id' => -1,
                        'idz' => $id_prog,
                        'program_id' => -1,
                        'nacin' => -1,
                        'srednja' => -1,
                        'talent' => -1,
                        'koncana_srednja' => KoncanaSrednjaSola::pluck('ime')
                    ]);
            }
        }
        return redirect('prijava');
    }

    public function findCandidates(Request $request){
        $search_string = $request->get('podatki');
        if($search_string != '') {
            $parts = explode(" ", $search_string);

            $kandidati = new \Illuminate\Database\Eloquent\Collection;
            foreach ($parts as $part) {
                $k = Uporabnik::where('ime', '=', $part)
                    ->orWhere('priimek', '=', $part)
                    ->orWhere('emso', '=', $part)
                    ->get();
                $kandidati = $kandidati->merge($k);
            }

            $matches = array();
            $no_matches = 0;
            foreach ($kandidati as $kandidat) {
                $no_matches = 0;
                foreach ($parts as $part) {
                    if (strcasecmp($kandidat->ime, $part) == 0 || strcasecmp($kandidat->priimek, $part) == 0 || $kandidat->emso == $part) {
                        if ($kandidat->vloga == VlogaUporabnika::KANDIDAT) $no_matches += 1;
                    }
                }
                array_push($matches, $no_matches);
            }

            if($no_matches != 0) {
                $highest = max($matches);
                foreach ($kandidati as $key => $kandidat) {
                    if ($matches[$key] != $highest) unset($kandidati[$key]);
                    else if ($kandidat->vloga != VlogaUporabnika::KANDIDAT) unset($kandidati[$key]);

                    $prijave = $kandidat->Prijave;
                    if (Auth::user()->vloga == 'fakulteta') {
                        if (count($prijave) == 0) unset($kandidati[$key]);
                    }
                    else {
                        if (Auth::user()->vloga == 'fakulteta') {
                            $id = Auth::user()->id;
                            $temp = 0;
                            foreach ($prijave as $prijava) {
                                $program = StudijskiProgram::where('id', '=', $prijava->id_studijskega_programa)->get();
                                $zavod = VisokosolskiZavod::where('id', '=', $program[0]->id_zavoda)->get();
                                if ($zavod[0]->id_skrbnika == $id) $temp = 1;
                            }
                            if ($temp == 0) unset($kandidati[$key]);
                        }
                    }
                }

                $kandidati = $kandidati->sort(function ($a, $b) {
                    if ($a->priimek === $b->priimek) {
                        if ($a->ime === $b->ime) {
                            return 0;
                        }
                        return $a->ime < $b->ime ? -1 : 1;
                    }
                    return $a->priimek < $b->priimek ? -1 : 1;
                });
            }

            if(count($kandidati) > 0) {
                return view('iskanje_kandidatov')
                    ->with([
                        'kandidati' => $kandidati,
                        'niz' => $search_string
                    ]);
            }
        }

        return view('iskanje_kandidatov')
            ->with([
                'niz' => $search_string
            ]);

    }

    public function loadCandidates(){
        return view('iskanje_kandidatov')
            ->with([
                'niz' => ''
            ]);
    }

    public function getList(Request $request)
    {
        $zavod_id = $request->get('zavod');
        $program_id = $request->get('program');
        $nacin = $request->get('nacin');
        $srednja = $request->get('izob');

        $zavod_id1 = $request->get('zavod');
        $program_id1 = $request->get('program');
        $nacin1 = $request->get('nacin');
        $srednja1 = $request->get('izob');

        $id = Auth::user() -> id;

        if(Auth::user()->vloga == 'fakulteta'){
            $zavod_id = VisokosolskiZavod::where('id_skrbnika', '=', $id)->orderBy('ime')->pluck('id')->first();
            $zavod_id1 =  $zavod_id;
        }

        if ($zavod_id != -1) {
            $zavodi = VisokosolskiZavod::orderBy('ime')->pluck('id');
            if(Auth::user()->vloga != 'fakulteta') $zavod_id = $zavodi[$zavod_id];

            if ($program_id != -1) {
                $programi = StudijskiProgram::where('id_zavoda', '=', $zavod_id)->orderBy('ime')->pluck('id');
                $program_id = $programi[$program_id];
            }
        }

        if ($nacin == 0) $nacin = 'Redni';
        else if ($nacin == 1) $nacin = 'Izredni';

        // vsi uporabniki
        $kandidati = Uporabnik::where('vloga', '=', VlogaUporabnika::KANDIDAT)
            ->join('prijava', function ($join) {
                $join->on('uporabnik.id', '=', 'prijava.id_kandidata');
            })->join('studijski_program', function ($join) {
                $join->on('prijava.id_studijskega_programa', '=', 'studijski_program.id');
            })->join('visokosolski_zavod', function ($join) {
                $join->on('studijski_program.id_zavoda', '=', 'visokosolski_zavod.id');
            })->get(array('uporabnik.id as id' ,'uporabnik.emso as emso', 'uporabnik.ime as ime', 'uporabnik.priimek as priimek', 'visokosolski_zavod.ime as zavod', 'studijski_program.ime as program', 'studijski_program.nacin_studija as nacin'));

        foreach ($kandidati as $key => $kandidat) {
            $kandidat->srednja = "";
            $zakljucek = PrijavaSrednjesolskaIzobrazba::where('id_kandidata', '=', $kandidat->id)->get();
            if(count($zakljucek)  > 0){
                $srednjasola = KoncanaSrednjaSola::where('id', '=', $zakljucek[0]->id_nacina_zakljucka)->get();
                $kandidat->srednja = $srednjasola[0]->ime;
                if ($srednja == 0) {
                    if ($zakljucek[0]->id_nacina_zakljucka != 2) unset($kandidati[$key]);
                }
                if ($srednja == 1) {
                    if ($zakljucek[0]->id_nacina_zakljucka != 3) unset($kandidati[$key]);
                }
                if ($srednja == 2) {
                    if ($zakljucek[0]->id_nacina_zakljucka != 4) unset($kandidati[$key]);
                }
            }
            if($zavod_id != -1){
                $zavod = VisokosolskiZavod::where('id', '=', $zavod_id)->get();
                if($kandidat->zavod != $zavod[0] -> ime) unset($kandidati[$key]);
            }
            if($program_id != -1){
                $program = StudijskiProgram::where('id', '=', $program_id)->get();
                if($kandidat->program != $program[0]->ime) unset($kandidati[$key]);
                if($kandidat->nacin != $program[0]->nacin_studija) unset($kandidati[$key]);
            }
            if($nacin != -1){
                if($kandidat->nacin != $nacin) unset($kandidati[$key]);
            }
        }

        $kandidati = $kandidati->sort(function ($a, $b) {
            if ($a->zavod === $b->zavod) {
                if ($a->program === $b->program) {
                    if ($a->priimek === $b->priimek) return 0;
                    return $a->priimek < $b->priimek ? -1 : 1;
                }
                return $a->program < $b->program ? -1 : 1;
            }
            return $a->zavod < $b->zavod ? -1 : 1;
        });

        $count = 1;
        foreach ($kandidati as $kandidat) {
            $kandidat->st = $count;
            $count += 1;
        }

        $zavodi = VisokosolskiZavod::where('id_skrbnika', '=', $id)->orderBy('ime')->pluck('ime');
        if(Auth::user()->vloga != 'fakulteta') $zavodi = VisokosolskiZavod::orderBy('ime')->pluck('ime');

        if ($request->get('izpisi')){
            return view('list_candidates')
                ->with([
                    'vz' => $zavodi,
                    'zavod_id' => $zavod_id1,
                    'program_id' => $program_id1,
                    'nacin' => $nacin1,
                    'srednja' => $srednja1,
                    'kandidati' => $kandidati,
                    'idz' => $this-> getNumberZavod(VisokosolskiZavod::where('id_skrbnika', '=', $id)->orderBy('ime')->pluck('id')->first())
                ]);
        }
        else {
            $pdf = \App::make('dompdf.wrapper');
            ini_set('max_execution_time', 300);
            $pdf->loadHTML(\View::make('pdf/seznamKandidatov')->with([
                'kandidati' => $kandidati
            ]));
            return $pdf->download('seznamKandidatov.pdf');
        }
    }
}