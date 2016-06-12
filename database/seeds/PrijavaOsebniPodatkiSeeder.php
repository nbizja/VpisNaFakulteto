<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrijavaOsebniPodatkiSeeder extends Seeder
{

    public function run()
    {
        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 14,
            'emso' => '1212997505019',
            'ime' => 'Vida',
            'priimek' => 'Sedmak',
            'spol' => 5,
            'datum_rojstva' => '1997-12-12',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 2,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 15,
            'emso' => '0606997500097',
            'ime' => 'Stanislav',
            'priimek' => 'Stanič',
            'spol' => 0,
            'datum_rojstva' => '1997-06-06',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 2,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 16,
            'emso' => '1212997500017',
            'ime' => 'Peter',
            'priimek' => 'Planinšek',
            'spol' => 0,
            'datum_rojstva' => '1997-12-12',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 2,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 17,
            'emso' => '0607997500093',
            'ime' => 'Štefan',
            'priimek' => 'Štefančič',
            'spol' => 0,
            'datum_rojstva' => '1997-07-06',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 5,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 18,
            'emso' => '1607997500097',
            'ime' => 'Tomaž',
            'priimek' => 'Velikonja',
            'spol' => 0,
            'datum_rojstva' => '1997-07-16',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 2,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 19,
            'emso' => '0604997500124',
            'ime' => 'Primož',
            'priimek' => 'Primožič',
            'spol' => 0,
            'datum_rojstva' => '1997-04-06',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 2,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 20,
            'emso' => '2607997500082',
            'ime' => 'Jernej',
            'priimek' => 'Jerančič',
            'spol' => 0,
            'datum_rojstva' => '1997-07-26',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 2,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 21,
            'emso' => '0808996500125',
            'ime' => 'Pavel',
            'priimek' => 'Padel',
            'spol' => 0,
            'datum_rojstva' => '1996-08-08',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 2,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 22,
            'emso' => '0604997505029',
            'ime' => 'Anita',
            'priimek' => 'Čebokli',
            'spol' => 5,
            'datum_rojstva' => '1997-04-06',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 2,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 23,
            'emso' => '1212994500008',
            'ime' => 'Mihael',
            'priimek' => 'Novak',
            'spol' => 0,
            'datum_rojstva' => '1994-12-12',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 2,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 24,
            'emso' => '0212997500013',
            'ime' => 'Stanko',
            'priimek' => 'Kocjančič',
            'spol' => 0,
            'datum_rojstva' => '1997-12-02',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 2,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 25,
            'emso' => '0212997505015',
            'ime' => 'Petra',
            'priimek' => 'Petek',
            'spol' => 5,
            'datum_rojstva' => '1997-12-02',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 3,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 26,
            'emso' => '1210997505016',
            'ime' => 'Bernarda',
            'priimek' => 'Bensa',
            'spol' => 5,
            'datum_rojstva' => '1997-10-12',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 5,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 27,
            'emso' => '0303998500187',
            'ime' => 'Bojan',
            'priimek' => 'Bojec',
            'spol' => 0,
            'datum_rojstva' => '1999-03-03',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 5,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 28,
            'emso' => '0303998505189',
            'ime' => 'Bojana',
            'priimek' => 'Bojec',
            'spol' => 5,
            'datum_rojstva' => '1998-03-03',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 3,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 29,
            'emso' => '0607997505095',
            'ime' => 'Jana',
            'priimek' => 'Klinar',
            'spol' => 5,
            'datum_rojstva' => '1997-07-06',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 2,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 30,
            'emso' => '0606997505099',
            'ime' => 'Mira',
            'priimek' => 'Varl Juhant',
            'spol' => 5,
            'datum_rojstva' => '1997-06-06',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 3,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 31,
            'emso' => '0101998505039',
            'ime' => 'Pavla',
            'priimek' => 'Pavlin',
            'spol' => 5,
            'datum_rojstva' => '1998-10-19',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 3,
            'id_drzavljanstva' => 3,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 32,
            'emso' => '0101998500037',
            'ime' => 'Pavel',
            'priimek' => 'Pavlin',
            'spol' => 0,
            'datum_rojstva' => '1998-01-01',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 5,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert([
            'id_kandidata' => 33,
            'emso' => '0201998505033',
            'ime' => 'Cita',
            'priimek' => 'Janša',
            'spol' => 5,
            'datum_rojstva' => '1998-02-19',
            'id_drzave_rojstva' => 705,
            'kraj_rojstva' => 'Ljubljana',
            'id_drzavljanstva' => 5,
            'kontaktni_telefon' => '030123456',
        ]);

        DB::table('prijava_osebni_podatki')->insert(
            [
                'id_kandidata' => 36,
                'emso' => '0604997500027',
                'ime' => 'Klemen',
                'priimek' => 'Klemenečič',
                'spol' => 5,
                'datum_rojstva' => '1997-04-06',
                'id_drzave_rojstva' => 705,
                'kraj_rojstva' => 'Ljubljana',
                'id_drzavljanstva' => 7,
                'kontaktni_telefon' => '030123456',
            ]);

        DB::table('prijava_osebni_podatki')->insert(
            [
                'id_kandidata' => 37,
                'emso' => '1607997505099',
                'ime' => 'Marjana',
                'priimek' => 'Viktorija Jelinčič',
                'spol' => 5,
                'datum_rojstva' => '1997-07-16',
                'id_drzave_rojstva' => 705,
                'kraj_rojstva' => 'Ljubljana',
                'id_drzavljanstva' => 7,
                'kontaktni_telefon' => '030123456',
            ]);

        DB::table('prijava_osebni_podatki')->insert(
            [
                'id_kandidata' => 38,
                'emso' => '0201998500031',
                'ime' => 'Božidar',
                'priimek' => 'Božič',
                'spol' => 5,
                'datum_rojstva' => '1998-02-19',
                'id_drzave_rojstva' => 705,
                'kraj_rojstva' => 'Ljubljana',
                'id_drzavljanstva' => 7,
                'kontaktni_telefon' => '030123456',
            ]);

        DB::table('prijava_osebni_podatki')->insert(
            [
                'id_kandidata' => 39,
                'emso' => '2607997505084',
                'ime' => 'Fani',
                'priimek' => 'Novak',
                'spol' => 5,
                'datum_rojstva' => '1997-07-26',
                'id_drzave_rojstva' => 705,
                'kraj_rojstva' => 'Ljubljana',
                'id_drzavljanstva' => 7,
                'kontaktni_telefon' => '030123456',
            ]);

        DB::table('prijava_osebni_podatki')->insert(
            [
                'id_kandidata' => 40,
                'emso' => '0604997500027',
                'ime' => 'Ivan',
                'priimek' => 'Ivančič',
                'spol' => 0,
                'datum_rojstva' => '1997-04-06',
                'id_drzave_rojstva' => 705,
                'kraj_rojstva' => 'Ljubljana',
                'id_drzavljanstva' => 7,
                'kontaktni_telefon' => '030123456',
            ]);
    }
}