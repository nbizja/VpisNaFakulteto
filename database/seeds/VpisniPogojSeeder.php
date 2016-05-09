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
            'id_elementa' => 'L411'
        ]);

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
            'id_elementa2' => 'LUZG'
        ]);

    }
}
