<?php

namespace App\Http\Controllers;


use App\Models\Logic\PrijavaValidator;
use App\Models\PrijavaNaslovZaPosiljanje;
use App\Models\PrijavaOsebniPodatki;
use App\Models\PrijavaPrebivalisce;
use App\Models\Repositories\VpisRepository;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class VpisController extends Controller
{
    private $vpisRepository;
    private $prijavaValidator;

    public function __construct(VpisRepository $vpisRepository, PrijavaValidator $prijavaValidator)
    {
        $this->vpisRepository = $vpisRepository;
        $this->prijavaValidator = $prijavaValidator;
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

    public function stalnoPrebivalisce()
    {
        return view('vpis.stalno_prebivalisce')->with([
            'stalnoPrebivalisce' => Auth::user()->prebivalisce()->first(),
            'naslovZaPosiljanje' => Auth::user()->naslovZaPosiljanje()->first(),
            'drzave' => $this->vpisRepository->drzave(),
            'obcine' => $this->vpisRepository->obcine(),
            'poste' => $this->vpisRepository->poste()
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
        $errors = [];

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
        $validator = $this->prijavaValidator->osebniPodatki($opInput);

        if (!$validator->passes()) {
            $errors = $validator->errors()->toArray();
        }

        if (!$this->prijavaValidator->veljavenEmso($opInput['emso'], $opInput['datum_rojstva'])) {
            $errors['emso'] = ['Neveljaven emso.'];
        }

        if (!empty($errors)) {
            return back()->with('errors', $errors);
        }

        $osebniPodatki = PrijavaOsebniPodatki::create($opInput);

        return redirect('vpis/stalno_prebivalisce');
    }

    public function shraniStalnoPrebivalisce(Request $request)
    {
        $errors = [];
        $spInput = [
            'id_kandidata'    => Auth::user()->id,
            'id_drzave'       => $request->request->get('drzava'),
            'naslov'          => $request->request->get('naslov'),
            'id_obcine'       => $request->request->get('obcina'),
            'postna_stevilka' => $request->request->get('posta'),
        ];

        $validator = $this->prijavaValidator->prebivalisce($spInput);
        if (!$validator->passes()) {
            $errors = $validator->errors()->toArray();
        }

        if (!$this->prijavaValidator->preveriKombinacijoPosteObcineDrzave(
            $spInput['postna_stevilka'], $spInput['id_obcine'] , $spInput['id_drzave'])) {

            $errors = array_merge($errors, [
                'postna_stevilka' => 'Kombinacija poštne številke, občine in države je neveljavna.',
                'obcina' => 'Kombinacija poštne številke, občine in države je neveljavna.',
                'drzava' => 'Kombinacija poštne številke, občine in države je neveljavna.',
            ]);
        }

        $posiljanjeInput = $spInput;
        if (!$request->request->get('isti_naslov_za_posiljanje')) {
            $posiljanjeInput = [
                'id_kandidata'    => Auth::user()->id,
                'id_drzave'       => $request->request->get('posiljanje_drzava'),
                'naslov'          => $request->request->get('posiljanje_naslov'),
                'id_obcine'       => $request->request->get('posiljanje_obcina'),
                'postna_stevilka' => $request->request->get('posiljanje_posta'),
            ];
            $posiljanjeValidator = $this->prijavaValidator->prebivalisce($posiljanjeInput);
            if (!$posiljanjeValidator->passes()) {
                $errors = array_merge($errors, $posiljanjeValidator->errors()->toArray());
            }
        }

        if (!empty($errors)) {
            return back()->with('errors', $errors);
        }

        $prebivalisce = PrijavaPrebivalisce::create($spInput);
        $naslovZaPosiljanje = PrijavaNaslovZaPosiljanje::create($posiljanjeInput);

        
        return redirect('vpis/srednjesolska_izobrazba');
    }

    public function shraniSrednjesolskoIzobrazbo(Request $request)
    {
        
    }
}