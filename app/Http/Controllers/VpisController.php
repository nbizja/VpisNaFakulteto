<?php

namespace App\Http\Controllers;


use App\Models\Logic\PrijavaValidator;
use App\Models\PrijavaOsebniPodatki;
use App\Models\Repositories\VpisRepository;
use Illuminate\Contracts\Validation\Validator;
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
            'drzavljanstva' => $this->vpisRepository->drzavljanstva(),
            'osebniPodatki' => Auth::user()->osebniPodatki()->first()
        ]);
    }

    public function shraniOsebnePodatke(Request $request)
    {
        $errors = [];
        $prijavaValidator = new PrijavaValidator();

        $opInput = [
            'emso'              => $request->request->get('emso'),
            'ime'               => $request->request->get('ime'),
            'priimek'           => $request->request->get('priimek'),
            'datum_rojstva'     => $request->request->get('datum_rojstva'),
            'id_drzave_rojstva' => $request->request->get('drzava_rojstva'),
            'kraj_rojstva'      => $request->request->get('kraj_rojstva'),
            'id_drzavljanstva'  => $request->request->get('drzavljanstvo'),
            'kontaktni_telefon' => $request->request->get('kontaktni_telefon')
        ];
        $validator = $prijavaValidator->osebniPodatki($opInput);

        if (!$validator->passes()) {
            $errors = $validator->errors()->toArray();
        }

        if (!$prijavaValidator->veljavenEmso($opInput['emso'], $opInput['datum_rojstva'])) {
            $errors['emso'] = ['Neveljaven emso.'];
        }
        
        if (!empty($errors)) {
            return back()->with('errors', $validator->errors());
        }

        $osebniPodatki = PrijavaOsebniPodatki::create($opInput);

        return redirect('vpis/stalno_prebivalisce');
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

    public function shraniStalnoPrebivalisce(Request $request)
    {

    }

    public function shraniSrednjesolskoIzobrazbo(Request $request)
    {

    }
}