<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeingKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kandidat', function ($table) {
            $table->foreign('id_drzave')->references('id')->on('drzava');
            $table->foreign('id_drzavljanstva')->references('id')->on('drzavljanstvo');
            $table->foreign('obcina_rojstva')->references('id')->on('obcina');
        });

        Schema::table('prijava', function ($table) {
            $table->foreign('id_kandidata')->references('id')->on('kandidat');
            $table->foreign('id_studijskega_programa')->references('id')->on('studijski_program');
        });

        Schema::table('visokosolski_zavod', function ($table) {
            $table->foreign('id_obcine')->references('id')->on('obcina');
            $table->foreign('id_skrbnika')->references('id')->on('skrbnik');
        });

        Schema::table('studijski_program', function ($table) {
            $table->foreign('id_zavoda')->references('id')->on('visokosolski_zavod');
        });

        Schema::table('matura', function ($table) {
            $table->foreign('id_srednje_sole')->references('id')->on('srednja_sola');
            $table->foreign('id_poklica')->references('id')->on('poklic');
        });
        Schema::table('poklicna_matura', function ($table) {
            $table->foreign('id_srednje_sole')->references('id')->on('srednja_sola');
            $table->foreign('id_poklica')->references('id')->on('poklic');
        });
        
        Schema::table('matura_predmet', function ($table) {
            $table->foreign('id_predmeta')->references('id')->on('element');
        });

        Schema::table('poklicna_matura_predmet', function ($table) {
            $table->foreign('id_predmeta')->references('id')->on('element');
        });


        Schema::table('vpisni_pogoj', function ($table) {
            $table->foreign('id_elementa')->references('id')->on('element');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
