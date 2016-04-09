<?php


use database\seeds\KandidatSeeder;
use database\seeds\SifrantiSeeder;
use database\seeds\SkrbnikTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(SkrbnikTableSeeder::class);
        $this->call(KandidatSeeder::class);
        //$this->call(SifrantiSeeder::class);
    }


}