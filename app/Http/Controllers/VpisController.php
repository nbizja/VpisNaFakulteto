<?php

namespace App\Http\Controllers;


use App\Models\Repositories\VpisRepository;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class VpisController extends Controller
{
    private $vpisRepository;

    public function __construct(VpisRepository $vpisRepository)
    {
        $this->vpisRepository = $vpisRepository;
    }

    public function prikazi()
    {
        $user = Auth::user();

        return $this->osebniPodatki();
    }
    
    public function osebniPodatki()
    {
        return view('vpis.osebni_podatki')->with([
            'drzave' => $this->vpisRepository->drzave(),
            'drzavljanstva' => $this->vpisRepository->drzavljanstva()
        ]);
    }

    public function stalnoPrebivalisce()
    {
        return view('vpis.stalno_prebivalisce')->with([
            'drzave' => $this->vpisRepository->drzave(),
            'obcine' => $this->vpisRepository->obcine(),
            'poste' => $this->vpisRepository->obcine()
        ]);
    }

    public function naslovZaObvestila()
    {
        return view('vpis.naslov_za_obvestila');
    }
    
    public function srednjeSolskaIzobrazbaPrikaz()
    {
        return view('vpis.srednjesolska_izobrazba')->with([
            'naciniZakljuckaSrednjeSole' => $this->vpisRepository->naciniZakljuckaSrednjeSole(),
            'srednjeSole' => $this->vpisRepository->srednjeSole()
        ]);
    }
    
    public function prijavaZaStudijPrikaz()
    {
        return view('vpis.prijava_za_studij')->with($this->vpisRepository->prijavaZaStudij());
    }

    public function shraniOsebnePodatke(Request $request)
    {

    }

    public function shraniStalnoPrebivalisce(Request $request)
    {

    }

    public function shraniSrednjesolskoIzobrazbo(Request $request)
    {

    }
}