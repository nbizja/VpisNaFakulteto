<?php

namespace database\seeds;

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

        DB::table('uporabnik')->insert([
            'emso' => '1307991500075',
            'ime' => 'Nejc',
            'priimek' => 'Bizjak',
            'username' => 'nb7232',
            'email' => 'nb7232@student.uni-lj.si',
            'password' => bcrypt('nb7232'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

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


        DB::table('uporabnik')->insert([
            'emso' => '1307991500076',
            'ime' => 'Špela',
            'priimek' => 'Bordon',
            'username' => 'nb7231',
            'email' => 'nb72332@student.uni-lj.si',
            'password' => bcrypt('nb7232'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '1307991500077',
            'ime' => 'Neža',
            'priimek' => 'Belej',
            'username' => 'nb7233',
            'email' => 'n2b7232@student.uni-lj.si',
            'password' => bcrypt('nb7232'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '1307991500078',
            'ime' => 'Ana',
            'priimek' => 'Novak',
            'username' => 'nb7234',
            'email' => 'nb72332@student.uni-lj.si',
            'password' => bcrypt('nb7232'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '1307991500079',
            'ime' => 'Veronika',
            'priimek' => 'Blažič',
            'username' => 'nb7235',
            'email' => '4@student.uni-lj.si',
            'password' => bcrypt('nb7232'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);

        DB::table('uporabnik')->insert([
            'emso' => '1307991500080',
            'ime' => 'Miha',
            'priimek' => 'Balon',
            'username' => 'nb7236',
            'email' => '4d@student.uni-lj.si',
            'password' => bcrypt('nb7232'),
            'vloga' => VlogaUporabnika::KANDIDAT
        ]);
    }
}
