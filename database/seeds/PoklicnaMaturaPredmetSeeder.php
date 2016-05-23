<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PoklicnaMaturaPredmetSeeder extends Seeder
{

    public function run()
    {
        DB::table('poklicna_matura_predmet')->truncate();

        DB::table('poklicna_matura_predmet')->insert([
            'emso' => '1307997505077',
            'id_predmeta' => 'M411',   //Nusa Pepel ima fiziko kot 5.predmet.
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

    }
}

