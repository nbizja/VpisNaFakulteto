<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRazvrstitevTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('razvrstitev', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_programa')->nullable();
            $table->integer('id_kandidata')->unsigned();
            $table->integer('mesto')->unsigned();
            $table->integer('stevilo_tock')->nullable();
            $table->integer('zelja');
            $table->string('vzrok_za_zavrnitev');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('razvrstitev');
    }
}
