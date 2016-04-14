<?php

namespace database\seeds;

use App\Models\Enums\VlogaUporabnika;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UporabnikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('uporabnik')->truncate();

        DB::table('uporabnik')->insert([
            'emso' => '1307991500075',
            'ime' => 'Nejc',
            'priimek' => 'Bizjak',
            'username' => 'nb7232',
            'email' => 'nb7232@student.uni-lj.si',
            'password' => bcrypt('nb7232'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert(
            [
                'ime' => 'Peter',
                'priimek' => 'Klepec',
                'username' => 'skrbnik',
                'email' => 'skrbnik@faks.me',
                'password' => bcrypt('skrbnik'),
                'vloga' => VlogaUporabnika::SKRBNIK_PROGRAMA
            ]);

        DB::table('uporabnik')->insert(
            [
                'ime' => 'Kralj',
                'priimek' => 'Matjaž',
                'username' => 'admin',
                'email' => 'admin@faks.me',
                'password' => bcrypt('admin'),
                'vloga' => VlogaUporabnika::ADMIN
            ]
        );
    }
}
