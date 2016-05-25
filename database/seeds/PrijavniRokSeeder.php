<?php

use Illuminate\Database\Seeder;


class PrijavniRokSeeder extends Seeder
{
    public function run()
    {
        DB::table('prijavni_rok')->truncate();
        DB::table('prijavni_rok')->insert([
            'studijsko_leto' => 2016,
            'zacetek' => '2016-05-01',
            'konec' => '2016-07-30'
        ]);
    }


}