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
            $table->string('email');
            $table->string('geslo');
            $table->string('vloga');
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
