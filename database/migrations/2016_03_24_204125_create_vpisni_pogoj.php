<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVpisniPogoj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vpisni_pogoj', function(BluePrint $table) { 
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_programa')->unsigned();
            $table->string('id_elementa');
            $table->string('tip');
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
        Schema::drop('vpisni_pogoj');
    }
}
