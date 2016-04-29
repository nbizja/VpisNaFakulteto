<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 15.4.2016
 * Time: 10:56
 */

namespace App\Http\Controllers\StudijskiProgrami;

use Illuminate\Support\Facades\Auth;
use App\Models\Repositories\StudijskiProgramiRepository;;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class SeznamController extends Controller
{
    private $studijskiProgrami;

    public function __construct(StudijskiProgramiRepository $sp)
    {
        $this->studijskiProgrami = $sp;
    }

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function seznamProgramov(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {

                if ($request->query->has('nacin')) {
                    if ($request->query->get('nacin') == "redni") {
                        $programi = $this->studijskiProgrami->ProgramiRedni()->sortBy('visokosolskiZavod.ime');
                    } else {
                        $programi = $this->studijskiProgrami->ProgramiIzredni()->sortBy('visokosolskiZavod.ime');
                    }
                    return view('studijskiProgrami.seznamProgramov', ['programi' => $programi]);

                } else if ($request->query->has('vrsta')) {
                    if ($request->query->get('vrsta') == "vs") {
                        $programi = $this->studijskiProgrami->ProgramiVs()->sortBy('visokosolskiZavod.ime');
                    } else {
                        $programi = $this->studijskiProgrami->ProgramiUn()->sortBy('visokosolskiZavod.ime');
                    }
                    return view('studijskiProgrami.seznamProgramov', ['programi' => $programi]);

                } else if ($request->query->has('omejitev')) {
                    if ($request->query->get('omejitev') == "da") {
                        $programi = $this->studijskiProgrami->ProgramiOmejitev()->sortBy('visokosolskiZavod.ime');
                    } else {
                        $programi = $this->studijskiProgrami->ProgramiBrezOmejitve()->sortBy('visokosolskiZavod.ime');
                    }
                    return view('studijskiProgrami.seznamProgramov', ['programi' => $programi]);
                }

                $programi = $this->studijskiProgrami->ProgramiAll()->sortBy('visokosolskiZavod.ime');
                return view('studijskiProgrami.seznamProgramov', ['programi' => $programi]);
            }
        }

        return redirect('prijava');
    }

}
