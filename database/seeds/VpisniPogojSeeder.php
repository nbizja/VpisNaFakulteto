<?php

namespace database\seeds;

use App\Models\VpisniPogoj;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VpisniPogojSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vpisni_pogoj')->truncate();

        //Ri-UN, redni
        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '838',
            'vnos_veljaven' => '1',
            'splosna_matura' => '1',
            'poklicna_matura' => '0',
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '838',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M411'
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '838',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M401'
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '838',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M781' //poklicna matura + racunalnistvo na poklicni maturi
        ]);


        //Ri-UN, izredni
        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '853',
            'vnos_veljaven' => '1',
            'splosna_matura' => '1',
            'poklicna_matura' => '0',
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '853',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M411'
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '853',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M401'
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '853',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M781' //poklicna matura + racunalnistvo na poklicni maturi
        ]);

        //RI-vs, redni
        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '852',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '852',
            'vnos_veljaven' => '1',
            'splosna_matura' => '1',
            'poklicna_matura' => '0',
        ]);


        //RI-vs, izredni
        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '837',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '837',
            'vnos_veljaven' => '1',
            'splosna_matura' => '1',
            'poklicna_matura' => '0',
        ]);

        /**************************************/

        //Upravljanje javnega sektorja, redni
        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '18',
            'vnos_veljaven' => '1',
            'splosna_matura' => '1',
            'poklicna_matura' => '0',
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '18',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M531'   //filozofija + poklicna matura
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '18',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M511'  //zgodovina + poklicna matura
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '18',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M541'   //psihologija + poklicna matura
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '18',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M701' //ekonomija + poklicna matura
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '18',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M521'  //sociologija + poklicna matura
        ]);

        //Upravljanje javnega sektorja, izredni
        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '856',
            'vnos_veljaven' => '1',
            'splosna_matura' => '1',
            'poklicna_matura' => '0',
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '856',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M531'   //filozofija + poklicna matura
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '856',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M511'  //zgodovina + poklicna matura
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '856',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M541'   //psihologija + poklicna matura
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '856',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M701' //ekonomija + poklicna matura
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '856',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M521'  //sociologija + poklicna matura
        ]);

        /**************************************/

        //Matematika UN, redni
        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '828',
            'vnos_veljaven' => '1',
            'splosna_matura' => '1',
            'poklicna_matura' => '0',
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '828',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'L401',   //matematika + poklicna matura
            'id_elementa2' => 'SM'
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '828',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M401'   //matematika(splošna m., osn.) + poklicna matura
        ]);


        //Matematika UN, izredni
        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '857',
            'vnos_veljaven' => '1',
            'splosna_matura' => '1',
            'poklicna_matura' => '0',
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '857',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'L401',   //matematika + poklicna matura
            'id_elementa2' => 'SM'
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '857',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'M401'   //matematika(splošna m., osn.) + poklicna matura
        ]);


        /**************************************/

        //Praktična matematika, redni
        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '858',
            'vnos_veljaven' => '1',
            'splosna_matura' => '1',
            'poklicna_matura' => '0',
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '858',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
        ]);

        //Praktična matematika, izredni
        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '829',
            'vnos_veljaven' => '1',
            'splosna_matura' => '1',
            'poklicna_matura' => '0',
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '829',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
        ]);

        /**************************************/

        //Gozdarstvo, redni
        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '776',
            'vnos_veljaven' => '1',
            'splosna_matura' => '1',
            'poklicna_matura' => '0',
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '776',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '0',
            'id_poklica' => '51001',
            'id_elementa' => 'M421'    //gozdarski tehnik + biologija na maturi
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '776',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '0',
            'id_poklica' => '51001',
            'id_elementa' => 'L421',    //gozdarski tehnik + biologija na poklicni maturi + mat.predmet
            'id_elementa2' => 'SM'
        ]);

        //Gozdarstvo, izredni
        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '859',
            'vnos_veljaven' => '1',
            'splosna_matura' => '1',
            'poklicna_matura' => '0',
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '859',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '0',
            'id_poklica' => '51001',
            'id_elementa' => 'L421',
            'id_elementa2' => 'SM'
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '859',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '0',
            'id_poklica' => '51001',
            'id_elementa' => 'M421',
        ]);

        /**************************************/

        //dramska igra
        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '822',
            'vnos_veljaven' => '1',
            'splosna_matura' => '1',
            'poklicna_matura' => '0',
            'id_elementa' => 'S442'
        ]);

        DB::table('vpisni_pogoj')->insert([
            'id_programa' => '822',
            'vnos_veljaven' => '1',
            'splosna_matura' => '0',
            'poklicna_matura' => '1',
            'id_elementa' => 'S442',
            'id_elementa2' => 'M561'
        ]);
    }
}
