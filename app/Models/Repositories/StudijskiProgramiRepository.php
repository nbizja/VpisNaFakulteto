<?php
/**
 * Created by PhpStorm.
 * User: nejc
 * Date: 4. 04. 2016
 * Time: 12:41
 */

namespace App\Models\Repositories;


use App\Models\Enums\VlogaUporabnika;
use App\Models\Uporabnik;
use App\Models\StudijskiProgram;
use App\Models\VisokosolskiZavod;

class StudijskiProgramiRepository
{

    public function ZavodByID($id) {

        return VisokosolskiZavod::where('id', $id)->first();
    }
	
	public function ZavodNameByID($id) {

        return VisokosolskiZavod::where('id', $id)->first()->ime;
    }
	
    public function ProgramByID($id) {

        return StudijskiProgram::where('id', $id)->first();
    }
	
	public function ProgramNameByID($id) {

        return StudijskiProgram::where('id', $id)->first()->ime;
    }

    public function ProgramiAll($embed = '') {

        return StudijskiProgram::with('visokosolskiZavod')->orderBy('ime', 'asc')->groupBy('ime')->get();
    }

    public function ProgramiZavod($idZavoda)
    {
        return StudijskiProgram::where('id_zavoda', $idZavoda)->orderBy('ime', 'asc')->get();
    }

    public function ZavodiAll() {
        return VisokosolskiZavod::where('id_obcine', 61)->orderBy('ime', 'asc')->get();
    }

}