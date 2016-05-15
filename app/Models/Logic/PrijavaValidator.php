<?php
/**
 * Created by PhpStorm.
 * User: Nejc
 * Date: 14.5.2016
 * Time: 18:01
 */

namespace App\Models\Logic;



use Illuminate\Support\Facades\Validator;

class PrijavaValidator
{
    private $poljaOsebniPodatki = [];
    
    public function osebniPodatki($input)
    {
        return Validator::make($input, [
            'ime'               => 'required|string|min:2',
            'priimek'           => 'required|string|min:2',
            'datum_rojstva'     => 'required|date',
            'id_drzave_rojstva' => 'required|int|min:1',
            'kraj_rojstva'      => 'required|string|min:2',
            'id_drzavljanstva'  => 'required|int|min:1',
            'kontaktni_telefon' => 'required|digits_between:9,9',
        ], [
            'ime'               => 'Ime mora vsebovati vsaj dve črki.',
            'priimek'           => 'Priimek mora vsebovati vsaj dve črki.',
            'id_drzave_rojstva' => 'Polje je obvezno',
            'kraj_rojstva'      => 'Kraj rojstva mora vsebovati vsaj dve črki.',
            'kontaktni_telefon' => 'Kontaktni telefon mora biti v obliki 030123456'
        ]);
    }

    /**
     * Preveri veljanost emsa
     *
     * @param string $emso
     * @param string $datumrojstva (mora biti primeren za strtotime funkcijo)
     * @return bool True. če je veljaven
     */
    public function veljavenEmso($emso, $datumrojstva)
    {
        if (strlen($emso) != 13) {
            return false;
        }

        $time = strtotime($datumrojstva);
        $emsoDatum = date('d', $time) . date('m', $time) . substr(date('Y', $time), 1);

        if (strpos($emso, $emsoDatum) !== 0) {
            return false;
        }

        if (!in_array(substr($emso, 7, 3), ['500', '505'])) {
            return false;
        }

        if (!is_numeric(substr($emso, 10))) {
            return false;
        }

        return true;
    }

}