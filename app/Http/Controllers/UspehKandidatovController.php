<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 23.5.2016
 * Time: 11:22
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Repositories\StudijskiProgramiRepository;
use App\Models\Repositories\VpisniPogojiRepository;;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class UspehKandidatovController extends Controller
{
    private $studijskiProgrami;
    private $vpisniPogoji;

    public function __construct(StudijskiProgramiRepository $sp, VpisniPogojiRepository $vp)
    {
        $this->studijskiProgrami = $sp;
        $this->vpisniPogoji = $vp;
    }

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    public function preveriPogoje()
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                return view('ustrezanjePogojem', ['id_kandidata' => 1]);

            }
        }

        return redirect('prijava');

    }
}