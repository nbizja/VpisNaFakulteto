<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Drzava;
use App\Models\Drzavljanstvo;
use App\Models\Matura;
use App\Models\MaturaPredmet;
use App\Models\PoklicnaMatura;
use App\Models\PoklicnaMaturaPredmet;
use App\Models\PrijavaNaslovZaPosiljanje;
use App\Models\PrijavaOsebniPodatki;
use App\Models\PrijavaPrebivalisce;
use App\Models\PrijavaSrednjesolskaIzobrazba;
use App\Models\PrijavniRok;
use App\Models\Uporabnik;
use App\Models\Prijava;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')->with('prijavniRok', PrijavniRok::all()->first());
    }

    public function loadInicializacija()
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'admin') {
                $today = date('Y-m-d');
                return view('inicializacija')->with('today', $today)->with('message', '');
            }
        }
        return redirect('prijava');
    }

    public function init(Request $request)
    {
        $today = date('Y-m-d');
        $zacetek = $request->get('zacetek');
        $konec = $request->get('konec');

        if(strlen($konec) > 1 && strlen($zacetek) > 1) {
            if ($konec < $zacetek) {
                return view('inicializacija')->with('today', $today)->with('message', 'Datum zaključka prijav mora biti večji od datuma začetka prijav');
            }

            PrijavniRok::truncate();
            $prijavni_rok = new PrijavniRok();
            $prijavni_rok->studijsko_leto = substr($zacetek, 0, 4);
            $prijavni_rok->zacetek = $zacetek;
            $prijavni_rok->konec = $konec;
            $prijavni_rok->save();

            Matura::truncate();
            MaturaPredmet::truncate();
            PoklicnaMatura::truncate();
            PoklicnaMaturaPredmet::truncate();
            Prijava::truncate();
            PrijavaNaslovZaPosiljanje::truncate();
            PrijavaPrebivalisce::truncate();
            PrijavaOsebniPodatki::truncate();
            PrijavaSrednjesolskaIzobrazba::truncate();
            Uporabnik::where('vloga', '=', 'kandidat')->delete();

            $message = "Inicializacija sistema uspešno opravljena! Matura (".Matura::count()."), MaturaPredmet (".MaturaPredmet::count().
                "), Prijava (".Prijava::count()."), Uporabnik (".Uporabnik::count().")";

            return view('inicializacija')->with('today', $today)->with('message', $message);
        }

        return view('inicializacija')->with('today', $today)->with('message', 'Manjkajo podatki za začetek in konec prijavnega roka');
    }
}
