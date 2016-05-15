<?php

namespace App\Http\Controllers;

use App\Models\KoncanaSrednjaSola;
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
        $talent = $request->get('talent');

        $zavod_id1 = $request->get('zavod');
        $program_id1 = $request->get('program');
        $nacin1 = $request->get('nacin');
        $srednja1 = $request->get('izob');
        $talent1 = $request->get('talent');

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

        if ($nacin == 0) $nacin = 'REDNI';
        else if ($nacin == 1) $nacin = 'IZREDNI';

        if ($talent == 0) $talent = 'DA';
        else if ($talent == 1) $talent = 'NE';

        // vsi uporabniki
        $kandidati = Uporabnik::where('vloga', '=', VlogaUporabnika::KANDIDAT)
            ->join('prijava', function ($join) {
                $join->on('uporabnik.id', '=', 'prijava.id_kandidata');
            })->join('studijski_program', function ($join) {
                $join->on('prijava.id_studijskega_programa', '=', 'studijski_program.id');
            })->join('visokosolski_zavod', function ($join) {
                $join->on('studijski_program.id_zavoda', '=', 'visokosolski_zavod.id');
            })->get(array('uporabnik.emso as id', 'uporabnik.ime as ime', 'uporabnik.priimek as priimek', 'visokosolski_zavod.ime as zavod', 'studijski_program.ime as program', 'studijski_program.nacin_studija as nacin', 'prijava.izredni_talent as talent'));

        if ($nacin != -1) {
            $kandidati_nacin = Uporabnik::where('vloga', '=', VlogaUporabnika::KANDIDAT)
                ->join('prijava', function ($join) {
                    $join->on('uporabnik.id', '=', 'prijava.id_kandidata');
                })->join('studijski_program', function ($join) use ($nacin) {
                    $join->on('prijava.id_studijskega_programa', '=', 'studijski_program.id')
                        ->where('studijski_program.nacin_studija', '=', $nacin);
                })->join('visokosolski_zavod', function ($join) {
                    $join->on('studijski_program.id_zavoda', '=', 'visokosolski_zavod.id');
                })->get(array('uporabnik.emso as id', 'uporabnik.ime as ime', 'uporabnik.priimek as priimek', 'visokosolski_zavod.ime as zavod', 'studijski_program.ime as program', 'studijski_program.nacin_studija as nacin', 'prijava.izredni_talent as talent'));

            $kandidati = $kandidati->intersect($kandidati_nacin);
        }

        if ($talent != -1) {
            $kandidati_nacin = Uporabnik::where('vloga', '=', VlogaUporabnika::KANDIDAT)
                ->join('prijava', function ($join) use ($talent) {
                    $join->on('uporabnik.id', '=', 'prijava.id_kandidata')
                        ->where('prijava.izredni_talent', '=', $talent);
                })->join('studijski_program', function ($join) {
                    $join->on('prijava.id_studijskega_programa', '=', 'studijski_program.id');
                })->join('visokosolski_zavod', function ($join) {
                    $join->on('studijski_program.id_zavoda', '=', 'visokosolski_zavod.id');
                })->get(array('uporabnik.emso as id', 'uporabnik.ime as ime', 'uporabnik.priimek as priimek', 'visokosolski_zavod.ime as zavod', 'studijski_program.ime as program', 'studijski_program.nacin_studija as nacin', 'prijava.izredni_talent as talent'));

            $kandidati = $kandidati->intersect($kandidati_nacin);
        }

        if ($program_id != -1) {
            $kandidati_nacin = Uporabnik::where('vloga', '=', VlogaUporabnika::KANDIDAT)
                ->join('prijava', function ($join) {
                    $join->on('uporabnik.id', '=', 'prijava.id_kandidata');
                })->join('studijski_program', function ($join) use ($program_id) {
                    $join->on('prijava.id_studijskega_programa', '=', 'studijski_program.id')
                        ->where('studijski_program.id', '=', $program_id);
                })->join('visokosolski_zavod', function ($join) {
                    $join->on('studijski_program.id_zavoda', '=', 'visokosolski_zavod.id');
                })->get(array('uporabnik.emso as id', 'uporabnik.ime as ime', 'uporabnik.priimek as priimek', 'visokosolski_zavod.ime as zavod', 'studijski_program.ime as program', 'studijski_program.nacin_studija as nacin', 'prijava.izredni_talent as talent'));

            $kandidati = $kandidati->intersect($kandidati_nacin);
        }

        if ($zavod_id != -1) {
            $kandidati_nacin = Uporabnik::where('vloga', '=', VlogaUporabnika::KANDIDAT)
                ->join('prijava', function ($join) {
                    $join->on('uporabnik.id', '=', 'prijava.id_kandidata');
                })->join('studijski_program', function ($join) {
                    $join->on('prijava.id_studijskega_programa', '=', 'studijski_program.id');
                })->join('visokosolski_zavod', function ($join) use ($zavod_id) {
                    $join->on('studijski_program.id_zavoda', '=', 'visokosolski_zavod.id')
                        ->where('visokosolski_zavod.id', '=', $zavod_id);
                })->get(array('uporabnik.emso as id', 'uporabnik.ime as ime', 'uporabnik.priimek as priimek', 'visokosolski_zavod.ime as zavod', 'studijski_program.ime as program', 'studijski_program.nacin_studija as nacin', 'prijava.izredni_talent as talent'));

            $kandidati = $kandidati->intersect($kandidati_nacin);
        }

        foreach ($kandidati as $key => $kandidat) {
            $kandidat->srednja = "";
            $poklicnaMatura = Uporabnik::join('poklicna_matura', 'poklicna_matura.emso', '=', 'uporabnik.emso')->where('uporabnik.emso', $kandidat->id)->count();
            $splosnaMatura = Uporabnik::join('matura', 'matura.emso', '=', 'uporabnik.emso')->where('uporabnik.emso', $kandidat->id)->count();

            if ($poklicnaMatura > 0) $kandidat->srednja = "Poklicna matura ";
            if ($splosnaMatura > 0) $kandidat->srednja = $kandidat->srednja . "Splošna matura ";
            if ($kandidat->srednja == "") $kandidat->srednja = "Ni podatka";
            if ($kandidat->talent == "") $kandidat->talent = "NE";

            if ($srednja == 0) {
                if ($splosnaMatura == 0) unset($kandidati[$key]);
            }
            if ($srednja == 1) {
                if ($poklicnaMatura == 0) unset($kandidati[$key]);
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
            $kandidat->id = $count;
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
                    'talent' => $talent1,
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