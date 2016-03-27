<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisokosolskiZavod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visokosolski_zavod', function(BluePrint $table) { 
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_obcine')->unsigned();
            $table->integer('id_skrbnika')->unsigned();
            $table->string('ime');
            $table->string('kratica');
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
        Schema::drop('visokosolski_zavod');
    }
}
