<?php

namespace App\Http\Controllers;

use App\Models\KoncanaSrednjaSola;
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