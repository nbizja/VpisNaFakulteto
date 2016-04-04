<?php

namespace database\seeds;

use Illuminate\Database\Seeder;

class KandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('uporabnik')->insert([
            'emso' => '1307991500075',
            'ime' => 'Nejc',
            'priimek' => 'Bizjak',
            'uporabnisko_ime' => 'nb7232',
            'email' => 'nb7232@student.uni-lj.si',
            'geslo' => bcrypt('nb7232'),
            'obcina_rojstva' => '',
            'id_drzave' => '',
            'id_drzavljanstva' => ''
        ]);
    }
}
