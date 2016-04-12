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
        return view('list_candidates')
            ->with([
                'vz' => VisokosolskiZavod::orderBy('ime')->pluck('ime')
            ]);
    }
}