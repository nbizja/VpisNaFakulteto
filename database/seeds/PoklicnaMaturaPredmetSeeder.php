<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PoklicnaMaturaPredmetSeeder extends Seeder
{

    public function run()
    {
        DB::table('poklicna_matura_predmet')->truncate();

        /*NUSA PEPEL - predmeti*/
        DB::table('poklicna_matura_predmet')->insert([
            'emso' => '1307997505077',
            'id_predmeta' => 'L101',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        DB::table('poklicna_matura_predmet')->insert([
            'emso' => '1307997505077',
            'id_predmeta' => 'L401',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        DB::table('poklicna_matura_predmet')->insert([
            'emso' => '1307997505077',
            'id_predmeta' => 'L902',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        DB::table('poklicna_matura_predmet')->insert([
            'emso' => '1307997505077',
            'id_predmeta' => 'L781',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        DB::table('poklicna_matura_predmet')->insert([
            'emso' => '1307997505077',
            'id_predmeta' => 'M411',   //Nusa Pepel ima fiziko kot 5.predmet.
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        /*MIHA BALON - predmeti*/
        DB::table('poklicna_matura_predmet')->insert([
            'emso' => '1407997500080',
            'id_predmeta' => 'L101',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        DB::table('poklicna_matura_predmet')->insert([
            'emso' => '1407997500080',
            'id_predmeta' => 'L401',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        DB::table('poklicna_matura_predmet')->insert([
            'emso' => '1407997500080',
            'id_predmeta' => 'L431',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        DB::table('poklicna_matura_predmet')->insert([
            'emso' => '1407997500080',
            'id_predmeta' => 'L421',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        /*MATEJ KOSEC - predmeti*/
        DB::table('poklicna_matura_predmet')->insert([
            'emso' => '1408997500686',
            'id_predmeta' => 'L101',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        DB::table('poklicna_matura_predmet')->insert([
            'emso' => '1408997500686',
            'id_predmeta' => 'L401',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        DB::table('poklicna_matura_predmet')->insert([
            'emso' => '1408997500686',
            'id_predmeta' => 'L431',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);

        DB::table('poklicna_matura_predmet')->insert([
            'emso' => '1408997500686',
            'id_predmeta' => 'L781',
            'ocena' => 4,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
        ]);
    }
}

