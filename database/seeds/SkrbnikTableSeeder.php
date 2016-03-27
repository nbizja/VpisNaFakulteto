<?php

namespace database\seeds;


use App\Models\Enums\VlogaSkrbnika;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkrbnikTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('skrbnik')->insert([
            'id' => 1,
            'ime' => 'Skrba',
            'Priimek' => 'Brba',
            'uporabnisko_ime' => 'skrbnik',
            'email' => 'skrbnik@faks.me',
            'password' => bcrypt('skrbnik'),
            'vloga' => VlogaSkrbnika::ADMIN
        ]);
    }

}