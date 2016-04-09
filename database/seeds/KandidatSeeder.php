<?php

namespace database\seeds;

use App\Models\Enums\VlogaUporabnika;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'username' => 'nb7232',
            'email' => 'nb7232@student.uni-lj.si',
            'password' => bcrypt('nb7232'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);
    }
}
