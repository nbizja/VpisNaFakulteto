<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PoklicnaMaturaSeeder extends Seeder
{

    public function run()
    {
        DB::table('poklicna_matura')->truncate();

        DB::table('poklicna_matura')->insert([
            'emso' => '1307997505077',
            'ime' => 'Nuša',
            'priimek' => 'Pepel',
            'ocena' => 16,  //tocke na maturi
            'opravil' => 1,
            'ocena_3_letnik' => 3.6,
            'ocena_4_letnik' => 3.2,
            'tip_kandidata' => 'redni',
            'id_srednje_sole' => 25001,  //Zdravstvena LJ
            'id_poklica' => 54811,   //kozmeticni tehnik
            'maksimum' => 23
        ]);

        DB::table('poklicna_matura')->insert([
            'emso' => '1407997500080',
            'ime' => 'Miha',
            'priimek' => 'Balon',
            'ocena' => 16,  //tocke na maturi
            'opravil' => 1,
            'ocena_3_letnik' => 3.6,
            'ocena_4_letnik' => 3.2,
            'tip_kandidata' => 'redni',
            'id_srednje_sole' => 39001,  //Gozdarska Postojna
            'id_poklica' => 51001,   //gozdarski tehnik
            'maksimum' => 23
        ]);

        DB::table('poklicna_matura')->insert([
            'emso' => '1408997500686',
            'ime' => 'Matej',
            'priimek' => 'Kosec',
            'ocena' => 19,  //tocke na maturi
            'opravil' => 1,
            'ocena_3_letnik' => 3.9,
            'ocena_4_letnik' => 4.2,
            'tip_kandidata' => 'redni',
            'id_srednje_sole' => 3002,  //Solski center Celje
            'id_poklica' => 53001,   //kemijski tehnik
            'maksimum' => 23
        ]);


        DB::table('poklicna_matura')->insert([
            'emso' => '1911997500131',
            'ime' => 'Peter',
            'priimek' => 'Visok',
            'ocena' => 16,  //tocke na maturi
            'opravil' => 1,
            'ocena_3_letnik' => 3.6,
            'ocena_4_letnik' => 3.2,
            'tip_kandidata' => 'redni',
            'id_srednje_sole' => 39001,  //Gozdarska Postojna
            'id_poklica' => 51001,   //gozdarski tehnik
            'maksimum' => 23
        ]);
    }
}

