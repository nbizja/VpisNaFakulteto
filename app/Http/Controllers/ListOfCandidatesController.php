<?php

namespace App\Http\Controllers;

use App\Models\KoncanaSrednjaSola;
use App\Models\StudijskiProgram;
use App\Models\Uporabnik;
use App\Models\VisokosolskiZavod;
use Illuminate\Http\Request;
use App\Models\Enums\VlogaUporabnika;

class ListOfCandidatesController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function loadPage()
    {
        return view('list_candidates')
            ->with([
                'vz' => VisokosolskiZavod::orderBy('ime')->pluck('ime'),
                'koncana_srednja' => KoncanaSrednjaSola::pluck('ime')
            ]);
    }

    public function getData($zavod_id) {
        $zavodi =  \App\Models\VisokosolskiZavod::orderBy('ime')->pluck('id');
        if($zavod_id > 0) {
            $zavod_id = $zavodi[$zavod_id - 1];
            $programi = \App\Models\StudijskiProgram::where('id_zavoda', '=', $zavod_id)->orderBy('ime')->pluck('ime');
            return Response::json($programi);
        }
        else return Response::json();
    }

    public function getList(Request $request)
    {
        $zavod_id = $request->get('zavod');
        $program_id = $request->get('program');
        $nacin = $request->get('nacin');
        $srednja = $request->get('izob');
        $talent = $request->get('talent');

        if($zavod_id != -1){
            $zavodi = VisokosolskiZavod::orderBy('ime')->pluck('id');
            $zavod_id = $zavodi[$zavod_id];

            if($program_id != -1){
                $programi = StudijskiProgram::where('id_zavoda', '=', $zavod_id)->orderBy('ime')->pluck('id');
                $program_id = $programi[$program_id];
            }
        }

        if($nacin == 0) $nacin = 'REDNI';
        else if ($nacin == 1) $nacin = 'IZREDNI';

        if($talent == 0) $talent = 'DA';
        else if ($talent == 1) $talent = 'NE';

        // vsi uporabniki
        $kandidati = Uporabnik::where('vloga', '=', VlogaUporabnika::KANDIDAT)
            ->join('prijava', function($join) {
                $join->on('uporabnik.id', '=', 'prijava.id_kandidata');
            })->join('studijski_program', function($join) {
                $join->on('prijava.id_studijskega_programa', '=', 'studijski_program.id');
            })->join('visokosolski_zavod', function($join) {
                $join->on('studijski_program.id_zavoda', '=', 'visokosolski_zavod.id');
            })->get(array('uporabnik.emso as id', 'uporabnik.ime as ime', 'uporabnik.priimek as priimek', 'visokosolski_zavod.ime as zavod', 'studijski_program.ime as program', 'studijski_program.nacin_studija as nacin', 'prijava.izredni_talent as talent'));

        if($nacin != -1) {
            $kandidati_nacin = Uporabnik::where('vloga', '=', VlogaUporabnika::KANDIDAT)
                ->join('prijava', function($join) {
                    $join->on('uporabnik.id', '=', 'prijava.id_kandidata');
                })->join('studijski_program', function($join) use ($nacin) {
                    $join->on('prijava.id_studijskega_programa', '=', 'studijski_program.id')
                        ->where('studijski_program.nacin_studija', '=', $nacin);
                })->join('visokosolski_zavod', function($join) {
                    $join->on('studijski_program.id_zavoda', '=', 'visokosolski_zavod.id');
                })->get(array('uporabnik.emso as id', 'uporabnik.ime as ime', 'uporabnik.priimek as priimek', 'visokosolski_zavod.ime as zavod', 'studijski_program.ime as program', 'studijski_program.nacin_studija as nacin', 'prijava.izredni_talent as talent'));

            $kandidati = $kandidati->intersect($kandidati_nacin);
        }

        if($talent != -1) {
            $kandidati_nacin = Uporabnik::where('vloga', '=', VlogaUporabnika::KANDIDAT)
                ->join('prijava', function($join)  use ($talent){
                    $join->on('uporabnik.id', '=', 'prijava.id_kandidata')
                    ->where('prijava.izredni_talent', '=', $talent);
                })->join('studijski_program', function($join) {
                    $join->on('prijava.id_studijskega_programa', '=', 'studijski_program.id');
                })->join('visokosolski_zavod', function($join) {
                    $join->on('studijski_program.id_zavoda', '=', 'visokosolski_zavod.id');
                })->get(array('uporabnik.emso as id', 'uporabnik.ime as ime', 'uporabnik.priimek as priimek', 'visokosolski_zavod.ime as zavod', 'studijski_program.ime as program', 'studijski_program.nacin_studija as nacin', 'prijava.izredni_talent as talent'));

            $kandidati = $kandidati->intersect($kandidati_nacin);
        }

        if($program_id != -1) {
            $kandidati_nacin = Uporabnik::where('vloga', '=', VlogaUporabnika::KANDIDAT)
                ->join('prijava', function($join) {
                    $join->on('uporabnik.id', '=', 'prijava.id_kandidata');
                })->join('studijski_program', function($join) use ($program_id) {
                    $join->on('prijava.id_studijskega_programa', '=', 'studijski_program.id')
                        ->where('studijski_program.id', '=', $program_id);
                })->join('visokosolski_zavod', function($join) {
                    $join->on('studijski_program.id_zavoda', '=', 'visokosolski_zavod.id');
                })->get(array('uporabnik.emso as id', 'uporabnik.ime as ime', 'uporabnik.priimek as priimek', 'visokosolski_zavod.ime as zavod', 'studijski_program.ime as program', 'studijski_program.nacin_studija as nacin', 'prijava.izredni_talent as talent'));

            $kandidati = $kandidati->intersect($kandidati_nacin);
        }

        if($zavod_id != -1) {
            $kandidati_nacin = Uporabnik::where('vloga', '=', VlogaUporabnika::KANDIDAT)
                ->join('prijava', function($join) {
                    $join->on('uporabnik.id', '=', 'prijava.id_kandidata');
                })->join('studijski_program', function($join) {
                    $join->on('prijava.id_studijskega_programa', '=', 'studijski_program.id');
                })->join('visokosolski_zavod', function($join) use ($zavod_id) {
                    $join->on('studijski_program.id_zavoda', '=', 'visokosolski_zavod.id')
                        ->where('visokosolski_zavod.id', '=', $zavod_id);
                })->get(array('uporabnik.emso as id', 'uporabnik.ime as ime', 'uporabnik.priimek as priimek', 'visokosolski_zavod.ime as zavod', 'studijski_program.ime as program', 'studijski_program.nacin_studija as nacin', 'prijava.izredni_talent as talent'));

            $kandidati = $kandidati->intersect($kandidati_nacin);
        }

        foreach($kandidati as $key => $kandidat) {
            $kandidat->srednja = "";
            $poklicnaMatura = Uporabnik::join('poklicna_matura', 'poklicna_matura.emso', '=', 'uporabnik.emso')->where('uporabnik.emso', $kandidat->id)->count();
            $splosnaMatura = Uporabnik::join('matura', 'matura.emso', '=', 'uporabnik.emso')->where('uporabnik.emso', $kandidat->id)->count();

            if($poklicnaMatura > 0) $kandidat->srednja = "Poklicna matura ";
            if($splosnaMatura > 0) $kandidat->srednja = $kandidat->srednja . "Splošna matura ";
            if($kandidat->srednja == "") $kandidat->srednja = "Ni podatka";
            if($kandidat->talent == "") $kandidat->talent = "NE";

            if($srednja == 0) {
                if($splosnaMatura == 0) unset($kandidati[$key]);
            }
            if($srednja == 1) {
                if($poklicnaMatura == 0) unset($kandidati[$key]);
            }

        }

        $kandidati = $kandidati->sort(function($a, $b) {
            if($a->zavod === $b->zavod) {
                if($a->program === $b->program) {
                    if($a->priimek === $b->priimek) return 0;
                    return $a->priimek < $b->priimek ? -1 : 1;
                }
                return $a->program < $b->program ? -1 : 1;
            }
            return $a->zavod < $b->zavod ? -1 : 1;
        });

        $pdf = \App::make('dompdf.wrapper');
        ini_set('max_execution_time', 300);
        $pdf->loadHTML(\View::make('list_candidates')->with([
                'vz' => VisokosolskiZavod::orderBy('ime')->pluck('ime'),
                'koncana_srednja' => KoncanaSrednjaSola::pluck('ime'),
                'kandidati' => $kandidati
            ]));
        return $pdf->download('studijskiProgrami.pdf');


        return view('list_candidates')
            ->with([
                'vz' => VisokosolskiZavod::orderBy('ime')->pluck('ime'),
                'koncana_srednja' => KoncanaSrednjaSola::pluck('ime'),
                'kandidati' => $kandidati
            ]);
    }
}