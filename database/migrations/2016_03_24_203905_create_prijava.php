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
        Schema::create('prijava', function(BluePrint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_kandidata')->unsigned();
            $table->integer('id_studijskega_programa')->unsigned();
            $table->integer('zelja');
            $table->date('datum_prijave');
            $table->integer('tocke');
            $table->string('izredni_talent');
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
        Schema::drop('prijava');
    }
}
