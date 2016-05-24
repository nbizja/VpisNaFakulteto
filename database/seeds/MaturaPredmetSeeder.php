<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MaturaPredmetSeeder extends Seeder
{

    public function run()
    {
        DB::table('matura_predmet')->truncate();

        /*SPELA BORDON - predmeti*/
        DB::table('matura_predmet')->insert([
            'emso' => '1307997505076',
            'id_predmeta' => 'M101',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        DB::table('matura_predmet')->insert([
            'emso' => '1307997505076',
            'id_predmeta' => 'M241',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        DB::table('matura_predmet')->insert([
            'emso' => '1307997505076',
            'id_predmeta' => 'M401',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        DB::table('matura_predmet')->insert([
            'emso' => '1307997505076',
            'id_predmeta' => 'M781',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        DB::table('matura_predmet')->insert([
            'emso' => '1307997505076',
            'id_predmeta' => 'M411',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);
    }
}

