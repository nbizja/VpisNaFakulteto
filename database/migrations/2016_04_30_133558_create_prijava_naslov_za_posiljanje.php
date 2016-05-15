<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrijavaNaslovZaPosiljanje extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prijava_naslov_za_posiljanje', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('id_kandidata');
            $table->integer('id_drzave');
            $table->string('naslov');
            $table->integer('id_obcine');
            $table->integer('postna_stevilka');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('prijava_naslov_za_posiljanje');
    }
}
