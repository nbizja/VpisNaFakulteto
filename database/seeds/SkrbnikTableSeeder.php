<?php

namespace database\seeds;


use App\Models\Enums\VlogaUporabnika;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkrbnikTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('uporabnik')->insert([
            'id' => 1,
            'ime' => 'Skrba',
            'priimek' => 'Brba',
            'username' => 'skrbnik',
            'email' => 'skrbnik@faks.me',
            'password' => bcrypt('skrbnik'),
            'vloga' => VlogaUporabnika::ADMIN
        ]);
    }

}