<?php

use App\Models\Enums\VlogaUporabnika;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UporabnikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('uporabnik')->truncate();


        DB::table('uporabnik')->insert(
            [
                'ime' => 'Peter',
                'priimek' => 'Klepec',
                'username' => 'skrbnik',
                'email' => 'skrbnik@faks.me',
                'password' => bcrypt('skrbnik'),
                'vloga' => VlogaUporabnika::SKRBNIK_PROGRAMA
            ]);

        DB::table('uporabnik')->insert(
            [
                'ime' => 'Neža',
                'priimek' => 'Belej',
                'username' => 'nezabelej',
                'email' => 'nezabelej@gmail.com',
                'password' => bcrypt('nezabelej812'),
                'vloga' => VlogaUporabnika::SKRBNIK_PROGRAMA
            ]);

        DB::table('uporabnik')->insert(
            [
                'ime' => 'Metka',
                'priimek' => 'Runovc',
                'username' => 'metkarunovc',
                'email' => 'metkarunovc1234@gmail.com',
                'password' => bcrypt('metkarunovc'),
                'vloga' => VlogaUporabnika::FAKULTETA
            ]);

        DB::table('uporabnik')->insert(
            [
                'ime' => 'Kralj',
                'priimek' => 'Matjaž',
                'username' => 'admin',
                'email' => 'admin@faks.me',
                'password' => bcrypt('admin'),
                'vloga' => VlogaUporabnika::ADMIN
            ]
        );

        /*KANDIDATI*/

        DB::table('uporabnik')->insert([
            'emso' => '1307991500075',
            'ime' => 'Nejc',
            'priimek' => 'Bizjak',
            'username' => 'nb7232',
            'email' => 'nb7232@student.uni-lj.si',
            'password' => bcrypt('nb7232'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);


        DB::table('uporabnik')->insert([
            'emso' => '1307997505076',
            'ime' => 'Špela',
            'priimek' => 'Bordon',
            'username' => 'spelabordon',
            'email' => 'spela.bordon@student.uni-lj.si',
            'password' => bcrypt('spelabordon'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '1307997505077',
            'ime' => 'Nuša',
            'priimek' => 'Pepel',
            'username' => 'nusapepel',
            'email' => 'nusapepel@gmail.com',
            'password' => bcrypt('nusapepel'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '1205997505192',
            'ime' => 'Ana',
            'priimek' => 'Novak',
            'username' => 'ananovak',
            'email' => 'ananovak@gmail.com',
            'password' => bcrypt('ananovak'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '2309993505074',
            'ime' => 'Veronika',
            'priimek' => 'Blažič',
            'username' => 'veronika',
            'email' => 'veronika.blazic@student.uni-lj.si',
            'password' => bcrypt('veronikablazic'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '1407997500080',
            'ime' => 'Miha',
            'priimek' => 'Balon',
            'username' => 'mihabalon',
            'email' => 'mihabalon@gmail.com',
            'password' => bcrypt('mihabalon'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '1408997500686',
            'ime' => 'Matej',
            'priimek' => 'Kosec',
            'username' => 'matejkosec',
            'email' => 'matejkosec@gmail.com',
            'password' => bcrypt('matejkosec'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '1412998500684',
            'ime' => 'Sofija',
            'priimek' => 'Bezer',
            'username' => 'sofijabezer',
            'email' => 'sofijabezer@gmail.com',
            'password' => bcrypt('sofijabezer'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '1911997500131',
            'ime' => 'Peter',
            'priimek' => 'Visok',
            'username' => 'petervisok',
            'email' => 'petervisok@gmail.com',
            'password' => bcrypt('petervisok'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '1212997505019',
            'ime' => 'Vida',
            'priimek' => 'Sedmak',
            'username' => 'vidasedmak',
            'email' => 'vidasedmak@gmail.com',
            'password' => bcrypt('vidasedmak'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '0606997500097 ',
            'ime' => 'Stanislav',
            'priimek' => 'Stanič',
            'username' => 'stanko',
            'email' => 'stanko@gmail.com',
            'password' => bcrypt('stanko'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '1212997500017 ',
            'ime' => 'Peter',
            'priimek' => 'Planinšek',
            'username' => 'pplaninsek',
            'email' => 'pplaninsek@gmail.com',
            'password' => bcrypt('pplaninsek123'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '0607997500093',
            'ime' => 'Štefan',
            'priimek' => 'Štefančič',
            'username' => 'stefan',
            'email' => 'stefan@gmail.com',
            'password' => bcrypt('stefan'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '1607997500097',
            'ime' => 'Tomaž',
            'priimek' => 'Velikonja',
            'username' => 'tvelikonja',
            'email' => 'tvelikonja@gmail.com',
            'password' => bcrypt('tomazv123'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '0604997500124',
            'ime' => 'Primož',
            'priimek' => 'Primožič',
            'username' => 'primozic',
            'email' => 'primozic@gmail.com',
            'password' => bcrypt('primozic'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '2607997500082',
            'ime' => 'Jernej',
            'priimek' => 'Jerančič',
            'username' => 'jerancic',
            'email' => 'jjerancic@gmail.com',
            'password' => bcrypt('jjerancic'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '0808996500125',
            'ime' => 'Pavel',
            'priimek' => 'Padel',
            'username' => 'ppadel',
            'email' => 'ppadel@gmail.com',
            'password' => bcrypt('ppadel'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);
    }
}
