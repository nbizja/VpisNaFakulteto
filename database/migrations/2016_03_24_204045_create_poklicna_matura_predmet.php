<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoklicnaMaturaPredmet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poklicna_matura_predmet', function(BluePrint $table) { 
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('emso');
            $table->string('id_predmeta');
            $table->integer('ocena');
            $table->boolean('opravil');
            $table->integer('ocena_3_letnik');
            $table->integer('ocena_4_letnik');
            $table->string('tip_predmeta');
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
        Schema::drop('poklicna_matura_predmet');
    }
}
