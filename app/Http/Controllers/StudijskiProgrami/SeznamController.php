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

    public function seznamProgramov()
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                $programi = $this->studijskiProgrami->ProgramiAll()->sortBy('visokosolskiZavod.ime');
                return view('studijskiProgrami.seznamProgramov', ['programi' => $programi]);
            }
        }

        return redirect('prijava');
    }

}
