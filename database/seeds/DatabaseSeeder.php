<?php


use database\seeds\UporabnikSeeder;
use database\seeds\VpisniPogojSeeder;
use database\seeds\KriterijSeeder;
use database\seeds\SifrantiSeeder;
use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

include 'UporabnikSeeder.php';

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
             VpisniPogojSeeder::class, KriterijSeeder::class,
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
        $this->call(UporabnikSeeder::class);

        foreach ($this->seeder_list as $seeder) {
            $this->call($seeder);
        }

    }
}

