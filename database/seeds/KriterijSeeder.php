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

        DB::table('kriterij')->truncate();

        DB::table('kriterij')->insert([
            'id_pogoja' => '1',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '1',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'utez' => '0.6'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '2',
            'vnos_veljaven' => '1',
            'ocene_34_letnika' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '2',
            'vnos_veljaven' => '1',
            'maturitetni_uspeh' => '1',
            'utez' => '0.4'
        ]);

        DB::table('kriterij')->insert([
            'id_pogoja' => '2',
            'vnos_veljaven' => '1',
            'id_elementa' => 'L411',
            'utez' => '0.2'
        ]);
    }
}
