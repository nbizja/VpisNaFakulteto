<?php

namespace App\Http\Controllers\Matura;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Matura;
use App\Models\MaturaPredmet;

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
		$ime = iconv('CP1250', 'UTF-8', $ime);
		$priimek = trim(substr($vrstica, 40, 24));
		$priimek = iconv('CP1250', 'UTF-8', $priimek);
		$ocena = trim(substr($vrstica, 66, 2));
		$opravil_znak = trim(substr($vrstica, 69, 1));
		$opravil = False;
		if ($opravil_znak == 'D') {
			$opravil = True;
		}
		$ocena_3_letnik = trim(substr($vrstica, 71, 1));
		$ocena_4_letnik = trim(substr($vrstica, 73, 1));
		$tip_kandidata = trim(substr($vrstica, 75, 1));
		$id_srednje_sole = trim(substr($vrstica, 77, 6));
		$id_poklica = trim(substr($vrstica, 84, 5));
		return array('emso' => $emso, 'ime' => $ime, 'priimek' => $priimek,
					 'ocena' => $ocena, 'opravil' => $opravil,
					 'ocena_3_letnik' => $ocena_3_letnik,
					 'ocena_4_letnik' => $ocena_4_letnik,
					 'tip_kandidata' => $tip_kandidata,
					 'id_srednje_sole' => $id_srednje_sole,
					 'id_poklica' => $id_poklica, 'maksimum' => 0);
	}
	
	private function preberiVrsticoMaturantPre($vrstica)
	{
		$emso = trim(substr($vrstica, 0, 13));
		$id_predmeta = trim(substr($vrstica, 14, 4));
		$ocena = trim(substr($vrstica, 19, 1));
		$ocena_3_letnik = trim(substr($vrstica, 21, 1));
		$ocena_4_letnik = trim(substr($vrstica, 23, 1));
		$opravil_znak = trim(substr($vrstica, 25, 1));
		$opravil = False;
		if ($opravil_znak == 'D') {
			$opravil = True;
		}
		$tip_predmeta = trim(substr($vrstica, 27, 1));
		return array('emso' => $emso, 'id_predmeta' => $id_predmeta,
					 'ocena' => $ocena, 'ocena_3_letnik' => $ocena_3_letnik,
					 'ocena_4_letnik' => $ocena_4_letnik, 'opravil' => $opravil,
					 'tip_predmeta' => $tip_predmeta);
	}
	
    public function naloziDatoteko(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->vloga == 'skrbnik') {

				$this->validate($request, [
					'datotekaMaturant' => 'mimes:txt',
					'datotekaMaturPre' => 'mimetypes:text/plain',
					]);
					
				$mat = False;
				$matPre = False;
				
				if ($request->hasFile('datotekaMaturant')) {
					$maturant = $request->file('datotekaMaturant');
					DB::statement('SET FOREIGN_KEY_CHECKS = 0');
					foreach(file($maturant) as $line) {
						$maturant_podatki = $this->preberiVrsticoMaturant($line);
						Matura::insert($maturant_podatki);
					}
					DB::statement('SET FOREIGN_KEY_CHECKS = 1');
					$mat = True;
				}
				
				if ($request->hasFile('datotekaMaturPre')) {
					$maturantpre = $request->file('datotekaMaturPre');
					DB::statement('SET FOREIGN_KEY_CHECKS = 0');
					foreach(file($maturantpre) as $line) {
						$maturantpre_podatki = $this->preberiVrsticoMaturantPre($line);
						MaturaPredmet::insert($maturantpre_podatki);
					}
					DB::statement('SET FOREIGN_KEY_CHECKS = 1');
					$matPre = True;
				}
				
				if ($mat or $matPre) {
					return back()->withFlashMessage('Podatki so bili uspešno uvoženi.');
				}
				
				return back();
            }
        }
    }
}
