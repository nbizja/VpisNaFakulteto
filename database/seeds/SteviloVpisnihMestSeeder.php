<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SteviloVpisnihMestSeeder extends Seeder
{
    public function run()
    {
        //FRI UNI
        DB::table('studijski_program')
        ->where('id', 838)
        ->update([
            'stevilo_vpisnih_mest' => 4,
            'stevilo_vpisnih_mest_tujci' => 4
        ]);

        //FRI VSS
        DB::table('studijski_program')
            ->where('id', 852)
            ->update([
                'stevilo_vpisnih_mest' => 4,
                'stevilo_vpisnih_mest_tujci' => 4
            ]);

        //FU
        DB::table('studijski_program')
            ->where('id', 18)
            ->update([
                'stevilo_vpisnih_mest' => 5,
                'stevilo_vpisnih_mest_tujci' => 5
            ]);

        //FU Izredni
        DB::table('studijski_program')
            ->where('id', 856)
            ->update([
                'stevilo_vpisnih_mest' => 3,
                'stevilo_vpisnih_mest_tujci' => 3
            ]);

        //Gozdarstvo
        DB::table('studijski_program')
            ->where('id', 776)
            ->update([
                'stevilo_vpisnih_mest' => 2,
                'stevilo_vpisnih_mest_tujci' => 2
            ]);
    }
}