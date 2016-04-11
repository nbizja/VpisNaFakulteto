<?php

namespace App\Http\Controllers;

use App\VisokosolskiZavod;

class ListOfCandidatesController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function loadPage()
    {
        $vz = VisokosolskiZavod::all();
        return view('list_candidates')
            ->with([
                'vz' => $vz
            ]);
    }
}