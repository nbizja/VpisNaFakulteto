<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkrbnik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skrbnik', function(BluePrint $table) { 
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('ime');
            $table->string('priimek');
            $table->string('uporabnisko_ime')->unique();
            $table->string('email');
            $table->string('password');
            $table->string('vloga');
            $table->rememberToken();
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
        Schema::drop('skrbnik');
    }
}
