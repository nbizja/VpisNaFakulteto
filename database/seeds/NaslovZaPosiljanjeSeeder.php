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
            'id_kandidata' => '14',
            'naslov' => 'Tržaška 22',
            'id_obcine' => '62',
            'postna_stevilka' => 1000,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '15',
            'naslov' => 'Aljaževa 5',
            'id_obcine' => '62',
            'postna_stevilka' => 1000,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '16',
            'naslov' => 'Slovenčeva 45',
            'id_obcine' => '62',
            'postna_stevilka' => 1000,
            'id_drzave' => 705,
        ]);

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

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '22',
            'naslov' => 'Podravska 33',
            'id_obcine' => '71',
            'postna_stevilka' => 2000,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '23',
            'naslov' => 'Večna pot 35',
            'id_obcine' => '71',
            'postna_stevilka' => 2000,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '24',
            'naslov' => 'Petrovska ulica 1',
            'postna_stevilka' => 1230,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '25',
            'naslov' => 'Litijska pot 2',
            'postna_stevilka' => 1270,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '26',
            'naslov' => 'Zvezdna ulica 2',
            'postna_stevilka' => 1270,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '27',
            'naslov' => 'Sončna pot 5',
            'postna_stevilka' => 1270,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '28',
            'naslov' => 'Kamniška 22',
            'postna_stevilka' => 1270,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '29',
            'naslov' => 'Jagovče 4',
            'postna_stevilka' => 1270,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '30',
            'naslov' => 'Rifengozd 99',
            'postna_stevilka' => 1270,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '31',
            'naslov' => 'Slap 44',
            'postna_stevilka' => 1241,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '32',
            'naslov' => 'Bistrica 34',
            'postna_stevilka' => 1241,
            'id_drzave' => 705,
        ]);

        DB::table('prijava_naslov_za_posiljanje')->insert([
            'id_kandidata' => '33',
            'naslov' => 'Hruševje 33',
            'postna_stevilka' => 1270,
            'id_drzave' => 705,
        ]);
    }
}

