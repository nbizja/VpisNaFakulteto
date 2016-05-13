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
class MaturaSeeder extends Seeder
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
        DB::table('matura')->truncate();

        DB::table('matura')->insert([
            'emso' => '1307991500075',
            'ime' => 'Nejc',
            'priimek' => 'Bizjak',
            'ocena' => 5,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
            'tip_kandidata' => 'redni',
            'id_srednje_sole' => 1,
            'id_poklica' => 1,
            'vnos_veljaven' => 1,
            'maksimum' => 22
        ]);

        DB::table('matura')->insert([
            'emso' => '1307991500076',
            'ime' => 'Špela',
            'priimek' => 'Bordon',
            'ocena' => 5,
            'opravil' => 1,
            'ocena_3_letnik' => 4,
            'ocena_4_letnik' => 4,
            'tip_kandidata' => 'redni',
            'id_srednje_sole' => 1,
            'id_poklica' => 1,
            'vnos_veljaven' => 1,
            'maksimum' => 22
        ]);

    }
}

