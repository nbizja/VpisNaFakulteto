<?php

namespace database\seeds;

use App\Models\Enums\VlogaUporabnika;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriterijSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // NE SPREMINJAJ VRSTNEGA REDA, KER SE BO PODRLO!

        DB::table('kriterij')->truncate();

        //Ri-UN, redni
        DB::table('kriterij')->insert([
            'id_pogoja' => '1',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '1',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '2',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '2',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '2',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M411',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '3',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '3',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '3',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M401',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '4',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '4',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '4',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M781',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        //Ri-UN, izredni

        DB::table('kriterij')->insert([
            'id_pogoja' => '5',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '5',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '6',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '6',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '6',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M411',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '7',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '7',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '7',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M401',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '8',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '8',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '8',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M781',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        /////////////////////////////////////////////

        //RI-vs, redni

        DB::table('kriterij')->insert([
            'id_pogoja' => '9',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '9',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '10',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '10',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        //RI-vs, izredni

        DB::table('kriterij')->insert([
            'id_pogoja' => '11',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '11',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '12',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '12',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        //Upravljanje javnega sektorja

        DB::table('kriterij')->insert([
            'id_pogoja' => '13',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '13',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '14',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '14',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '14',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M531',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '15',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '15',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '15',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M511',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '16',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '16',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '16',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M541',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '17',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '17',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '17',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M701',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '18',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '18',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '18',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M521',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        // javni sektor izredno

        DB::table('kriterij')->insert([
            'id_pogoja' => '19',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '19',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '20',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '20',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '20',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M531',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '21',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '21',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '21',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M511',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '22',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '22',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '22',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M541',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '23',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '23',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '23',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M701',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '24',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '24',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '24',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M521',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        // matematika UN redni

        DB::table('kriterij')->insert([
            'id_pogoja' => '25',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '25',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.3'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '25',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '0',
            'ocene_34_letnika' => '0',
            'id_elementa' => 'MAT',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '25',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '0',
            'ocene_34_letnika' => '0',
            'id_elementa' => 'M401',
            'utez' => '0.3'
        ]);
        /********/

        DB::table('kriterij')->insert([
            'id_pogoja' => '26',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '26',
            'vnos_veljaven' => '1',
            'id_elementa' => 'L401',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '26',
            'vnos_veljaven' => '1',
            'id_elementa' => 'MAT',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.3'
        ]);


        DB::table('kriterij')->insert([
            'id_pogoja' => '26',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.1'
        ]);
        /***********/

        DB::table('kriterij')->insert([
            'id_pogoja' => '27',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '27',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.1'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '27',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M401',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '27',
            'vnos_veljaven' => '1',
            'id_elementa' => 'MAT',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.3'
        ]);


        //matematika UN izredni

        DB::table('kriterij')->insert([
            'id_pogoja' => '31',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '31',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.3'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '31',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '0',
            'ocene_34_letnika' => '0',
            'id_elementa' => 'MAT',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '31',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '0',
            'ocene_34_letnika' => '0',
            'id_elementa' => 'M401',
            'utez' => '0.3'
        ]);
        /********/

        DB::table('kriterij')->insert([
            'id_pogoja' => '32',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '32',
            'vnos_veljaven' => '1',
            'id_elementa' => 'L401',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '32',
            'vnos_veljaven' => '1',
            'id_elementa' => 'MAT',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.3'
        ]);


        DB::table('kriterij')->insert([
            'id_pogoja' => '32',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.1'
        ]);
        /***********/

        DB::table('kriterij')->insert([
            'id_pogoja' => '33',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '33',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.1'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '33',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M401',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '33',
            'vnos_veljaven' => '1',
            'id_elementa' => 'MAT',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.3'
        ]);



        // prakticna matematika redni

        DB::table('kriterij')->insert([
            'id_pogoja' => '34',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '34',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '35',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '35',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        // prakticna matematika izredni

        DB::table('kriterij')->insert([
            'id_pogoja' => '36',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '36',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '37',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '37',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        //gozdarstvo redni

        DB::table('kriterij')->insert([
            'id_pogoja' => '38',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '38',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '40',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '40',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '40',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M421',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        // gozdarstvo izredni

        DB::table('kriterij')->insert([
            'id_pogoja' => '41',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '41',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '43',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '43',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '43',
            'vnos_veljaven' => '1',
            'id_elementa' => 'L421',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        //gozdarstvo dodatni pogoj

        DB::table('kriterij')->insert([
            'id_pogoja' => '39',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '39',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '39',
            'vnos_veljaven' => '1',
            'id_elementa' => 'SM',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.4'
        ]);



        // ISRM redni

        DB::table('kriterij')->insert([
            'id_pogoja' => '28',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '28',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'ocene_34_letnika' => '0',
            'utez' => '0.6'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '28',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '0',
            'ocene_34_letnika' => '0',
            'id_elementa' => 'MAT',
            'utez' => '0.2'
        ]);


        /********/

        DB::table('kriterij')->insert([
            'id_pogoja' => '29',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.3'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '29',
            'vnos_veljaven' => '1',
            'id_elementa' => 'SM',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.3'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '29',
            'vnos_veljaven' => '1',
            'id_elementa' => 'MAT',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);


        DB::table('kriterij')->insert([
            'id_pogoja' => '29',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);
        /***********/

        DB::table('kriterij')->insert([
            'id_pogoja' => '30',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '1',
            'utez' => '0.3'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '30',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '30',
            'vnos_veljaven' => '1',
            'id_elementa' => 'M401',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.3'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '30',
            'vnos_veljaven' => '1',
            'id_elementa' => 'MAT',
            'ocene_34_letnika' => '0',
            'maturitetni_uspeh' => '0',
            'utez' => '0.2'
        ]);

    }
}
