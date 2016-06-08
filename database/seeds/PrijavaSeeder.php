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

       /* DB::table('prijava')->insert([
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
       */

        /*************PRIJAVE (Spela Bordon)****************/
        /*
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
        */
        /*************PRIJAVE (Nusa Pepel)****************/
        /*
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
        */
        /*************PRIJAVE (Miha Balon)****************/
        /*
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
         */
        /*************PRIJAVE (Matej Kosec)****************/
        /*
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

        /*************PRIJAVE (Sofija Bezer)****************/
        /*
        DB::table('prijava')->insert([
            'id_kandidata' => '12',
            'id_studijskega_programa' => '852',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '12',
            'id_studijskega_programa' => '858',
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);


        /*************PRIJAVE (Peter Visok)****************/
        /*
        DB::table('prijava')->insert([
            'id_kandidata' => '13',
            'id_studijskega_programa' => '838',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '13',
            'id_studijskega_programa' => '776',
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '13',
            'id_studijskega_programa' => '828',
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Vida Sedmak)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '14',
            'id_studijskega_programa' => '828',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '14',
            'id_studijskega_programa' => '848',
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '14',
            'id_studijskega_programa' => '858',
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Stanislav Stanič)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '15',
            'id_studijskega_programa' => '776',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '15',
            'id_studijskega_programa' => '838',
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '15',
            'id_studijskega_programa' => '18',
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Peter Planinsek)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '16',
            'id_studijskega_programa' => '828',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '16',
            'id_studijskega_programa' => '848',
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '16',
            'id_studijskega_programa' => '858',
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Stefan Stefancic)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '17',
            'id_studijskega_programa' => '838',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '17',
            'id_studijskega_programa' => '852',
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);


        /*************PRIJAVE (Tomaz Velikonja)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '18',
            'id_studijskega_programa' => '838',
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '18',
            'id_studijskega_programa' => '852',
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Primož Primožič)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '19',
            'id_studijskega_programa' => '852', //FRI, VSP
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '19',
            'id_studijskega_programa' => '776', //BF, GOZD
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '19',
            'id_studijskega_programa' => '18', //FU, UJS
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Jernej Jerančič)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '20',
            'id_studijskega_programa' => '838', //FRI, UNI
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '20',
            'id_studijskega_programa' => '828', //FMF, Mat
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '20',
            'id_studijskega_programa' => '18', //FU, UJS
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);
        

        /*************PRIJAVE (Anita Čebokli)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '22',
            'id_studijskega_programa' => '852', //FRI, VSS
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '22',
            'id_studijskega_programa' => '18', //FU
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '22',
            'id_studijskega_programa' => '776', //GOZD
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Mihael Novak)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '23',
            'id_studijskega_programa' => '838', //FRI, UNI
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '23',
            'id_studijskega_programa' => '848', //IŠRM
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '23',
            'id_studijskega_programa' => '858', //Pr. mat
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Stanko Kocjančič)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '24',
            'id_studijskega_programa' => '776', //Gozd
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '24',
            'id_studijskega_programa' => '18', //FU
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '24',
            'id_studijskega_programa' => '838', //FRI UNI
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Petra Petek)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '25',
            'id_studijskega_programa' => '18', //FU
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Bernarda Bensa)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '26',
            'id_studijskega_programa' => '838', //FRI UNI
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '26',
            'id_studijskega_programa' => '852', //FRI VSS
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '26',
            'id_studijskega_programa' => '18', //FU
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Bojan Bojec)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '27',
            'id_studijskega_programa' => '18', //FU
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '27',
            'id_studijskega_programa' => '838', //FRI UNI
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Bojana Bojec)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '28',
            'id_studijskega_programa' => '18', //FU
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '28',
            'id_studijskega_programa' => '838', //FRI UNI
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '28',
            'id_studijskega_programa' => '852', //FRI VSS
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Jana Klinar)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '29',
            'id_studijskega_programa' => '838', //FRI UNI
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '29',
            'id_studijskega_programa' => '852', //FRI VSS
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '29',
            'id_studijskega_programa' => '18', //FU
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Mira Varl Juhant)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '30',
            'id_studijskega_programa' => '18', //FU
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '30',
            'id_studijskega_programa' => '852', //FRI VSS
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Pavla Pavlin)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '31',
            'id_studijskega_programa' => '18', //FU
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '31',
            'id_studijskega_programa' => '776', //Gozd
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '31',
            'id_studijskega_programa' => '852', //FRI VSS
            'zelja' => 3,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Pavel Pavlin)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '32',
            'id_studijskega_programa' => '838', //FRI UNI
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '32',
            'id_studijskega_programa' => '852', //FRI VSS
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);

        /*************PRIJAVE (Cita Janša)****************/
        DB::table('prijava')->insert([
            'id_kandidata' => '33',
            'id_studijskega_programa' => '18', //FU
            'zelja' => 1,
            'datum_prijave' => '2016-05-13',
        ]);

        DB::table('prijava')->insert([
            'id_kandidata' => '33',
            'id_studijskega_programa' => '852', //FRI VSS
            'zelja' => 2,
            'datum_prijave' => '2016-05-13',
        ]);
    }
}

