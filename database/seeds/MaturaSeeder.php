<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MaturaSeeder extends Seeder
{

    public function run()
    {
        DB::table('matura')->truncate();

        DB::table('matura')->insert([
            'emso' => '1307991500075',
            'ime' => 'Nejc',
            'priimek' => 'Bizjak',
            'ocena' => 26,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
            'tip_kandidata' => 'redni',
            'id_srednje_sole' => 1,
            'id_poklica' => 1,
            'vnos_veljaven' => 1,
            'maksimum' => 22
        ]);

        DB::table('matura')->insert([
            'emso' => '1307997505076',
            'ime' => 'Špela',
            'priimek' => 'Bordon',
            'ocena' => 30,  //tocke na maturi
            'opravil' => 1,
            'ocena_3_letnik' => 4.5,
            'ocena_4_letnik' => 4.7,
            'tip_kandidata' => 'redni',
            'id_srednje_sole' => 17003,  //gimnazija Koper
            'id_poklica' => 59911,   //gimnazija
            'vnos_veljaven' => 1,
            'maksimum' => 34
        ]);
    }
}

