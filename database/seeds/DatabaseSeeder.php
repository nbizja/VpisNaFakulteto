<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;


/**
 * Calls seeders specified in list.
 *
 * Names of data files must exactly match the names of tables.
 * The leading line of each data file must be a header.
 * Names of colums in data file must exactly match colums in database
 * table.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Initialize the DatabaseSeeder object.
     * Creates class variable `seeder_list` with names of classes of seeders.
     *
     * @return void
     */
     public function __construct()
     {
         $this->seeder_list = array(DrzavljanstvoSeeder::class,
             DrzavaSeeder::class, ElementSeeder::class, 
             KoncanaSrednjaSolaSeeder::class, NacinStudijaSeeder::class,
             ObcinaSeeder::class, PoklicSeeder::class, PostaSeeder::class,
             SrednjaSolaSeeder::class, StudijskiProgramSeeder::class,
             UniverzaSeeder::class, VisokosolskiZavodSeeder::class,
             VrstaStudijaSeeder::class);
     }

    /**
     * Calls seeders in order specified in `seeder_list`.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        foreach ($this->seeder_list as $seeder) {
            $this->call($seeder);
        }
    }
}

