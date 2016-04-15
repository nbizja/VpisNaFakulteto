<?php

namespace App\Http\Controllers;

use App\KoncanaSrednjaSola;
use App\VisokosolskiZavod;
use Illuminate\Http\Request;

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

    public function getList(Request $request)
    {
        $zavod_id = $request->get('zavod');
        $zavod_id1 = $request->get('zavod1');
        echo $zavod_id;
        echo $zavod_id1;


        $zavodi =  \App\VisokosolskiZavod::orderBy('ime')->pluck('id');
    }
}