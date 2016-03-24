<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrijava extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prijava', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kandidata');
            $table->integer('id_studijskega_programa');
            $table->integer('zelja');
            $table->date('datum_prijave');
            $table->integer('tocke');
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
        Schema::drop('prijava');
    }
}
