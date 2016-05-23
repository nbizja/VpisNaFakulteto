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
    }
}
