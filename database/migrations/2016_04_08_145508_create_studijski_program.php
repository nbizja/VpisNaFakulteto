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
        Schema::create('studijski_program', function (Blueprint $table) { 
            $table->engine = 'InnoDB';
            $table->increments('id');
			$table->integer('id_zavoda')->unsigned();
            $table->string('nacin_studija');
            $table->string('ime');
            $table->integer('stevilo_vpisnih_mest');
            $table->integer('omejitev_vpisa');
			$table->string('sifra');
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
