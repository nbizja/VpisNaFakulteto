<?php


use database\seeds\KandidatSeeder;
use database\seeds\SifrantiSeeder;
use database\seeds\SkrbnikTableSeeder;
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
class DatabaseSeeder extends CsvSeeder
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
             KoncanaSrednjaSolaSeeder::class, 
             ObcinaSeeder::class, PoklicSeeder::class, PostaSeeder::class,
             SrednjaSolaSeeder::class, StudijskiProgramSeeder::class,
             VisokosolskiZavodSeeder::class);
     }

    /**
     * Calls seeders in order specified in `seeder_list`.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
		Eloquent::unguard();
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($this->seeder_list as $seeder) {
            $this->call($seeder);
        }
        $this->call(SkrbnikTableSeeder::class);
        $this->call(KandidatSeeder::class);
        //$this->call(SifrantiSeeder::class);
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
}

