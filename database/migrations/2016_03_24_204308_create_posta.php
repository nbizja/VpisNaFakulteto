<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posta', function(BluePrint $table) { 
            $table->engine = 'InnoDB';
            $table->integer('postna_stevilka',50);
            $table->string('ime');

            $table->primary('postna_stevilka');
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
        Schema::drop('posta');
    }
}
