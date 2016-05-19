<?php

namespace App\Models\Logic;

use App\Models\Drzava;
use App\Models\Obcina;
use App\Models\Posta;
use App\Models\Prijava;
use Illuminate\Support\Facades\Validator;

class PrijavaValidator
{
    private $poljaOsebniPodatki = [];
    
    public function osebniPodatki($input)
    {
        return Validator::make($input, [
            'ime'               => 'required|string|min:2',
            'priimek'           => 'required|string|min:2',
            'spol'              => 'required|in:0,5',
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
            'kontaktni_telefon' => 'Kontaktni telefon mora biti v obliki 030123456',
            'spol'              => 'Spol mora biti označen.'
        ]);
    }

    public function srednjesolskaIzobrazba($input)
    {
        return Validator::make($input, [
            'datum_izdaje_spricevala' => 'required|date',
            'id_nacina_zakljucka' => 'required|int|min:1',
            'id_drzave' => 'required|int|min:0',
            'id_srednje_sole' => 'required|int|min:1',
            'sifra_maturitetnega_predmeta' => 'alpha_num',
        ], ['datum_izdaje_spricevala.required' => 'Manjka datum izdaje spričevala.',
            'datum_izdaje_spricevala.date' => 'Datum izdaje spričevala je v napačnem formatu (pravilen primer 15.06.2016)']
        );
    }

    /**
     * Preveri veljanost emsa
     *
     * @param string $emso
     * @param string $datumrojstva (mora biti primeren za strtotime funkcijo)
     * @param int $spol
     * @return bool True. če je veljaven
     */
    public function veljavenEmso($emso, $datumrojstva, $spol)
    {
        if (strlen($emso) != 13) {
            return false;
        }

        $time = strtotime($datumrojstva);
        $emsoDatum = date('d', $time) . date('m', $time) . substr(date('Y', $time), 1);

        if (strpos($emso, $emsoDatum) !== 0) {
            return false;
        }

        if (substr($emso, 7, 3) != ('50' . $spol)) {
            return false;
        }

        if (!is_numeric(substr($emso, 10))) {
            return false;
        }

        $emsoSum = 0;
        $utezi = [7,6,5,4,3,2,7,6,5,4,3,2];
        foreach ($utezi as $i => $utez) {
            $emsoSum += $emso[$i] * $utez;
        }

        return (11 - ($emsoSum % 11) == $emso[12]);
    }

    public function prebivalisce($input)
    {
        return Validator::make($input, [
            'naslov'          => 'required|string|min:4',
        ], [
            'naslov.required' => 'Naslov je obvezen.',
        ]);
    }

    /**
     * Preveri pravilnost kombinacije pošte, občine in države (vse v sloveniji ali vse tujina)
     * 
     * @param int $postnaStevilka
     * @param int $idObcine
     * @param int $idDrzave
     * @return bool
     */
    public function preveriKombinacijoPosteObcineDrzave($postnaStevilka, $idObcine, $idDrzave)
    {
        $drzava = Drzava::find($idDrzave);

        if ($drzava->ime != 'SLOVENIJA') {
            return $idObcine == 1 && $postnaStevilka == 0;
        }

        $obcina = Obcina::find($idObcine);
        $posta = Posta::find($postnaStevilka);

        if (empty($obcina) || empty($posta)) {
            return false;
        }

        return $obcina->id > 1 && $posta->postna_stevilka > 0;
    }
    
    public function validirajStudijskiProgram(Prijava $prijava)
    {
        if ((int)$prijava->id_studijskega_programa < 1) {
            return false;
        }
        
        return !empty($prijava->studijskiProgram());
    }
}