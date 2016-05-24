<?php

namespace App\Http\Controllers\Matura;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MaturaController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';


    public function uvoziPodatke()
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {
                return view('matura/uvoziPodatkeOMaturi');
            }
        }

        return redirect('prijava');
    }

	private function preberiVrsticoMaturant($vrstica)
	{
		$emso = trim(substr($vrstica, 0, 13));
		$ime = trim(substr($vrstica, 14, 25));
		$priimek = trim(substr($vrstica, 40, 24));
		$uspeh = trim(substr($vrstica, 66, 2));
		$opravil = trim(substr($vrstica, 69, 1));
		$uspeh_3 = trim(substr($vrstica, 71, 1));
		$uspeh_4 = trim(substr($vrstica, 73, 1));
		$tip_kandidata = trim(substr($vrstica, 75, 1));
		$srednja_sola = trim(substr($vrstica, 77, 6));
		$poklic = trim(substr($vrstica, 84, 5));
		echo($priimek);
		echo('<br/>');
		return array('emso' => $emso, 'ime' => $ime, 'priimek' => $priimek,
					 'uspeh' => $uspeh, 'opravil' => $opravil,
					 'uspeh_3' => $uspeh_3, 'uspeh_4' => $uspeh_4,
					 'tip_kandidata' => $tip_kandidata,
					 'srednja_sola' => $srednja_sola, 'poklic' => $poklic);
	}
	
	private function preberiVrsticoMaturantPre($vrstica)
	{
		$emso = trim(substr($vrstica, 0, 13));
		$id_predmet = trim(substr($vrstica, 14, 4));
		$ocena = trim(substr($vrstica, 19, 1));
		$ocena_3 = trim(substr($vrstica, 21, 1));
		$ocena_4 = trim(substr($vrstica, 23, 1));
		$opravil = trim(substr($vrstica, 25, 1));
		$tip_predmeta = trim(substr($vrstica, 27, 1));
		return array('emso' => $emso, 'id_predmet' => $id_predmet,
					 'ocena' => $ocena, 'ocena_3' => $ocena_3,
					 'ocena_4' => $ocena_4, 'opravil' => $opravil,
					 'tip_predmeta' => $tip_predmeta);
	}
	
    public function naloziDatoteko(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {

				$this->validate($request, [
					'datotekaMaturant' => 'required|mimes:txt',
					'datotekaMaturPre' => 'required|mimetypes:text/plain',
					]);
				
				$maturant = $request->file('datotekaMaturant');
				foreach(file($maturant) as $line) {
					$maturant_podatki = $this->preberiVrsticoMaturant($line);
				}
				
				$maturantpre = $request->file('datotekaMaturPre');
				foreach(file($maturantpre) as $line) {
					$maturantpre_podatki = $this->preberiVrsticoMaturantPre($line);
				}
            }
        }
    }

}
