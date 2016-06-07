<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 7.6.2016
 * Time: 9:08
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Repositories\StudijskiProgramiRepository;;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class NalepkeKandidatovController extends Controller
{
    private $studijskiProgrami;

    public function __construct(StudijskiProgramiRepository $sp)
    {
        $this->studijskiProgrami = $sp;
    }

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    public function pridobiSeznam()
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                $fakultete = $this->studijskiProgrami->ZavodiAll();
                $programi = $this->studijskiProgrami->ProgramiAll();
                return view('nalepke_kandidati', ['fakultete' => $fakultete, 'programi' => $programi]);
            }
        }

        return redirect('prijava');
    }


}
