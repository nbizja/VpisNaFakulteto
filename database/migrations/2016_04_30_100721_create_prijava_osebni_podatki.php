<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrijavaOsebniPodatki extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prijava_osebni_podatki', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('id_kandidata');
            $table->string('emso');
            $table->string('ime');
            $table->string('priimek');
            $table->integer('spol');
            $table->date('datum_rojstva');
            $table->integer('id_drzave_rojstva');
            $table->string('kraj_rojstva');
            $table->integer('id_drzavljanstva');
            $table->string('kontaktni_telefon');
            $table->boolean('veljavno');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('prijava_osebni_podatki');
    }
}
