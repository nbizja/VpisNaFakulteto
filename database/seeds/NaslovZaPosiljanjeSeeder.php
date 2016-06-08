<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Calls seeders specified in list.
 *
 * Names of data files must exactly match the names of tables.
 * The leading line of each data file must be a header.
 * Names of colums in data file must exactly match colums in database
 * table.
 */
class NaslovZaPosiljanjeSeeder extends Seeder
{
    /**
     * Initialize the DatabaseSeeder object.
     * Creates class variable `seeder_list` with names of classes of seeders.
     *
     * @return void
     */

    /**
     * Calls seeders in order specified in `seeder_list`.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prijava_naslov_za_posiljanje')->truncate();

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '17',
            'naslov' => 'Hubadova 3',
            'id_obcine' => '62',
            'postna_stevilka' => 1000,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '18',
            'naslov' => 'Dunajska 267',
            'id_obcine' => '62',
            'postna_stevilka' => 1000,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '19',
            'naslov' => 'Ljubljanska 12',
            'id_obcine' => '12',
            'postna_stevilka' => 3000,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '20',
            'naslov' => 'Gornikova 39',
            'id_obcine' => '71',
            'postna_stevilka' => 2000,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '21',
            'naslov' => 'Pohorska ulica 99',
            'id_obcine' => '71',
            'postna_stevilka' => 2000,
            'id_drzave' => 705,
        ]);
    }
}

