<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;


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
            $table->string('emso')->index();
            $table->string('ime');
            $table->string('priimek');
            $table->string('uporabnisko_ime')->unique();
            $table->string('email');
            $table->string('geslo');
            $table->string('zeton');
            $table->integer('obcina_rojstva')->unsigned();
            $table->integer('id_drzave')->unsigned();
            $table->integer('id_drzavljanstva')->unsigned();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Schema::drop('kandidat');
    }
}
