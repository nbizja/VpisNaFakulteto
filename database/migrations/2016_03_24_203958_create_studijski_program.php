<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudijskiProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studijski_program', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_zavoda');
            $table->string('nacin');
            $table->string('ime');
            $table->integer('stevilo_vpisnih_mest');
            $table->integer('omejitev_vpisa');
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
        Schema::drop('studijski_program');
    }
}
