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
class PrijavaSeeder extends Seeder
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
        DB::table('prijava')->truncate();

        DB::table('prijava')->insert([
            'id_kandidata' => '1',
            'id_studijskega_programa' => '838',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
            'tocke' => '11',
            'izredni_talent' => 'NE'
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '5',
            'id_studijskega_programa' => '838',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
            'tocke' => '11',
            'izredni_talent' => 'NE'
        ]);


        DB::table('prijava')->insert([
            'id_kandidata' => '8',
            'id_studijskega_programa' => '838',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
            'tocke' => '11',
            'izredni_talent' => 'NE'
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '9',
            'id_studijskega_programa' => '837',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
            'tocke' => '11',
            'izredni_talent' => 'NE'
        ]);

        /*************PRIJAVE (Spela Bordon)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '6',
            'id_studijskega_programa' => '838',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '6',
            'id_studijskega_programa' => '776',
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '6',
            'id_studijskega_programa' => '828',
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Nusa Pepel)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '7',
            'id_studijskega_programa' => '838',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '7',
            'id_studijskega_programa' => '776',
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '7',
            'id_studijskega_programa' => '828',
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Miha Balon)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '10',
            'id_studijskega_programa' => '838',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '10',
            'id_studijskega_programa' => '776',
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '10',
            'id_studijskega_programa' => '828',
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Matej Kosec)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '11',
            'id_studijskega_programa' => '838',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '11',
            'id_studijskega_programa' => '852',
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '11',
            'id_studijskega_programa' => '858',
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

    }
}

