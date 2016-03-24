<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKandidat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kandidat', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('emso');
            $table->string('ime');
            $table->string('priimek');
            $table->string('uporabnisko_ime');
            $table->string('email');
            $table->string('geslo');
            $table->string('zeton');
            $table->string('obcina_rojstva');
            $table->string('drzava');
            $table->string('drzavljanstvo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Schema::drop('kandidat');
    }
}
