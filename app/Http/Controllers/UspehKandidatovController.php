<?php
/**
 * Created by PhpStorm.
 * User: Neza
 * Date: 23.5.2016
 * Time: 11:22
 */

namespace App\Http\Controllers;

use App\Models\Repositories\VpisRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Repositories\PrijavaRepository;;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\Uporabnik;

class UspehKandidatovController extends Controller
{
    private $prijavaRepo;
    private $vpisRepo;

    public function __construct(PrijavaRepository $pr, VpisRepository $vr)
    {
        $this->prijavaRepo = $pr;
        $this->vpisRepo = $vr;
    }

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    public function preveriPogoje($idKandidata)
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                $kandidat = $this->prijavaRepo->uporabnikById($idKandidata);
                if (!($kandidat->poklicnaMatura->isEmpty())) {
                    $tipMature = 1;
                    $matura = $kandidat->poklicnaMatura->first();
                } else if (!($kandidat->matura->isEmpty())) {
                    $tipMature = 0;
                    $matura = $kandidat->matura->first();
                };
                return view('ustrezanjePogojem', ['kandidat' => $kandidat, 'matura' => $matura, 'tipMature' => $tipMature])
                    ->with($this->vpisRepo->pregledPrijave($kandidat));
            }
        }

        return redirect('prijava');

    }
}