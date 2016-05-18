<?php

namespace App\Http\Controllers;


use App\Models\Logic\PrijavaValidator;
use App\Models\Prijava;
use App\Models\PrijavaNaslovZaPosiljanje;
use App\Models\PrijavaOsebniPodatki;
use App\Models\PrijavaPrebivalisce;
use App\Models\PrijavaSrednjesolskaIzobrazba;
use App\Models\Repositories\VpisRepository;
use App\Models\Uporabnik;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        if ($this->jePrijavaOddana($user)) {
            return redirect('vpis/pregled');
        }
        if (empty($user->osebniPodatki()->first())) {
            return redirect('vpis/osebni_podatki');
        }
        if (empty($user->prebivalisce()->first())) {
            return redirect('vpis/stalno_prebivalisce');
        }
        if (empty($user->srednjesolskaIzobrazba()->first())) {
            return redirect('vpis/srednjesolska_izobraba');
        }
        if (empty($user->prijava()->first())) {
            return redirect('vpis/prijava_za_studij');
        }

        return redirect('vpis/pregled');
    }
    
    public function osebniPodatki()
    {
        if ($this->jePrijavaOddana(Auth::user())) {
            return redirect('vpis/pregled');
        }

        return view('vpis.osebni_podatki')->with([
            'drzave' => $this->vpisRepository->drzave(),
            'drzavljanstva' => $this->vpisRepository->drzavljanstva(),
            'osebniPodatki' => Auth::user()->osebniPodatki()->first()
        ]);
    }

    public function stalnoPrebivalisce()
    {
        if ($this->jePrijavaOddana(Auth::user())) {
            return redirect('vpis/pregled');
        }

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
        if ($this->jePrijavaOddana(Auth::user())) {
            return redirect('vpis/pregled');
        }

        return view('vpis.naslov_za_obvestila');
    }
    
    public function srednjeSolskaIzobrazbaPrikaz()
    {
        if ($this->jePrijavaOddana(Auth::user())) {
            return redirect('vpis/pregled');
        }

        return view('vpis.srednjesolska_izobrazba')->with($this->vpisRepository->srednjesolskaIzobrazba(Auth::user()));
    }
    
    public function prijavaZaStudijPrikaz()
    {
        if ($this->jePrijavaOddana(Auth::user())) {
            return redirect('vpis/pregled');
        }

        return view('vpis.prijava_za_studij')->with($this->vpisRepository->prijavaZaStudij(Auth::user()));
    }
    
    public function pregled()
    {
        $uporabnik = Auth::user();
        if ($uporabnik->prijave()->get()->isEmpty()) {
            return redirect('/');
        }

        return view('vpis.pregled')
            ->with($this->vpisRepository->pregledPrijave($uporabnik));
    }

    public function shraniOsebnePodatke(Request $request)
    {
        $uporabnik = Auth::user();
        if ($this->jePrijavaOddana($uporabnik)) {
            return redirect('vpis/pregled');
        }

        $errors = [];

        $opInput = [
            'id_kandidata'      => $uporabnik->id,
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
        $opInput['datum_rojstva'] = date('Y-m-d', strtotime($opInput['datum_rojstva']));

        if ($opInput['id_drzavljanstva'] != 2) {
            $datumRojstva = strtotime($opInput['datum_rojstva']);
            $opInput['emso'] = date('d', $datumRojstva) . date('m', $datumRojstva) . substr(date('Y', $datumRojstva), 1) . '0' . str_pad($uporabnik->id, 5, '0', STR_PAD_LEFT);
        } elseif (!$this->prijavaValidator->veljavenEmso($opInput['emso'], $opInput['datum_rojstva'])) {
            $errors['emso'] = ['Neveljaven emso.'];
        }

        if (!empty($errors)) {
            return back()->with('errors', $errors);
        }
        $uporabnik->osebniPodatki()->get()->each(function($op) {
           $op->delete();
        });
        PrijavaOsebniPodatki::create($opInput);

        return redirect('vpis/stalno_prebivalisce');
    }

    public function shraniStalnoPrebivalisce(Request $request)
    {
        $uporabnik = Auth::user();
        if ($this->jePrijavaOddana($uporabnik)) {
            return redirect('vpis/pregled');
        }

        $errors = [];
        $spInput = [
            'id_kandidata'    => $uporabnik->id,
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
                'id_kandidata'    => $uporabnik->id,
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

        $uporabnik->prebivalisce()->get()->each(function($naslov) {
            $naslov->delete();
        });
        $uporabnik->naslovZaPosiljanje()->get()->each(function($naslov) {
            $naslov->delete();
        });
        $prebivalisce = PrijavaPrebivalisce::create($spInput);

        $naslovZaPosiljanje = PrijavaNaslovZaPosiljanje::create($posiljanjeInput);

        
        return redirect('vpis/srednjesolska_izobrazba');
    }

    public function shraniSrednjesolskoIzobrazbo(Request $request)
    {
        $uporabnik = Auth::user();
        if ($this->jePrijavaOddana($uporabnik)) {
            return redirect('vpis/pregled');
        }

        $input = [
            'id_kandidata' => $uporabnik->id,
            'id_nacina_zakljucka' => $request->request->get('nacin_zakljucka'),
            'id_drzave' => $request->request->get('drzava_srednje_sole'),
            'id_srednje_sole' => $request->request->get('srednja_sola'),
            'sifra_maturitetnega_predmeta' => $request->request->get('maturitetni_predmet'),
            'ime_srednje_sole' => $request->request->get('srednja_sola_tujina'),
            'datum_izdaje_spricevala' => $request->request->get('datum_izdaje_spricevala')
        ];
        $validator = $this->prijavaValidator->srednjesolskaIzobrazba($input);
        if (!$validator->passes()) {
            return back()->with('errors', $validator->errors()->all());
        }
        $input['datum_izdaje_spricevala'] = date('Y-m-d', strtotime($input['datum_izdaje_spricevala']));
        $srednjesolskaIzobrazba = new PrijavaSrednjesolskaIzobrazba($input);
        if ($srednjesolskaIzobrazba->id_srednje_sole == 0 && empty($srednjesolskaIzobrazba->ime_srednje_sole)) {
            return back()->with([
                'status' => 'danger',
                'message' => 'Manjkajoče ime srednje šole.'
            ]);
        }
        $trenutniPodatki = $uporabnik->srednjesolskaIzobrazba()->first();
        if (!empty($trenutniPodatki)) {
            $trenutniPodatki->delete();
        }
        $srednjesolskaIzobrazba->save();
        
        return redirect('vpis/prijava_za_studij');
    }
    
    public function shraniPrijavoZaStudij(Request $request)
    {
        $uporabnik = Auth::user();
        if ($this->jePrijavaOddana($uporabnik)) {
            return redirect('vpis/pregled');
        }

        $prvaZelja = new Prijava([
            'id_kandidata' => $uporabnik->id,
            'id_studijskega_programa' => $request->request->get('studijski_program_1'),
            'zelja' => 1,
            'datum_prijave' => date('Y-m-d'),
            'tocke' => 0,
            'izredni_talent' => 0
        ]);
        $izbraniProgrami = [$prvaZelja->id_studijskega_programa];

        if (!$this->prijavaValidator->validirajStudijskiProgram($prvaZelja)) {
            return back()->with([
                'status' => 'danger',
                'message' => '1. želja: Neveljaven studijski program'
            ]);
        }
        if ($request->request->get('studijski_program_2') > 0) {
            $drugaZelja = new Prijava([
                'id_kandidata' => $uporabnik->id,
                'id_studijskega_programa' => $request->request->get('studijski_program_2'),
                'zelja' => 2,
                'datum_prijave' => date('Y-m-d'),
                'tocke' => 0,
                'izredni_talent' => 0
            ]);

            if (!$this->prijavaValidator->validirajStudijskiProgram($drugaZelja)) {
                return back()->with(['status' => 'danger',
                    'message' => '2. želja: Neveljaven studijski program'
                ]);
            }
            if (in_array($drugaZelja->id_studijskega_programa, $izbraniProgrami)) {
                return back()->with(['status' => 'danger',
                    'message' => '2. želja: Podvojena izbira programa!'
                ]);
            }
            $izbraniProgrami[] = $drugaZelja->id_studijskega_programa;
        }

        if ($request->request->get('studijski_program_3') > 0) {
            $tretjaZelja = new Prijava([
                'id_kandidata' => $uporabnik->id,
                'id_studijskega_programa' => $request->request->get('studijski_program_3'),
                'zelja' => 3,
                'datum_prijave' => date('Y-m-d'),
                'tocke' => 0,
                'izredni_talent' => 0
            ]);
            if (!$this->prijavaValidator->validirajStudijskiProgram($tretjaZelja)) {
                return back()->with(['status' => 'danger',
                    'message' => '3. želja: Neveljaven studijski program'
                ]);
            }
            if (in_array($tretjaZelja->id_studijskega_programa, $izbraniProgrami)) {
                return back()->with(['status' => 'danger',
                    'message' => '3. želja: Podvojena izbira programa!'
                ]);
            }
        }
        DB::beginTransaction();
        try {
            $uporabnik->prijave()->get()->each(function($prijava) {
               $prijava->delete();
            });
            $prvaZelja->save();
            if (isset($drugaZelja)) {
                $drugaZelja->save();
            }
            if (isset($tretjaZelja)) {
                $tretjaZelja->save();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return back()->with('errors', ['status' => 'danger',
                'message' => 'Napaka pri shranjevanju.'
            ]);
        }

        return redirect('vpis/pregled');
    }

    public function oddajaPrijave()
    {
        $uporabnik = Auth::user();
        $uporabnik->datum_oddaje_prijave = date('Y-m-d');
        $uporabnik->save();

        return redirect('vpis/pregled');
    }

    public function izbrisPrijave()
    {
        $uporabnik = Auth::user();
        $uporabnik->datum_oddaje_prijave = '';
        $uporabnik->save();

        $uporabnik->prijave()->get()->each(function($prijava) {
           $prijava->delete();
        });

        $uporabnik->srednjesolskaIzobrazba()->first()->delete();
        $uporabnik->naslovZaPosiljanje()->first()->delete();
        $uporabnik->prebivalisce()->first()->delete();
        $uporabnik->osebniPodatki->first()->delete();

        return redirect('/');
    }

    public function tiskPrijave()
    {
        $uporabnik = Auth::user();
        if (!$this->jePrijavaOddana($uporabnik)) {
            return redirect('vpis');
        }

        $pdf = \App::make('dompdf.wrapper');
        ini_set('max_execution_time', 300);

        $pdf->loadHTML(view('pdf.prijava')
            ->with($this->vpisRepository->pregledPrijave($uporabnik))
            ->with('uporabnik', $uporabnik)
        );

        return $pdf->stream();
        //return $pdf->download('prijava.pdf');
    }

    private function jePrijavaOddana(Uporabnik $uporabnik)
    {
        return !empty($uporabnik->datum_oddaje_prijave);
    }
}