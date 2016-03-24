<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matura', function(Blueprint $table) {
            $table->string('emso');
            $table->string('ime');
            $table->string('priimek');
            $table->integer('ocena');
            $table->boolean('opravil');
            $table->integer('ocena_3_letnik');
            $table->integer('ocena_4_letnik');
            $table->string('tip_kandidata');
            $table->integer('id_srednje_sole');
            $table->integer('id_poklica');
            $table->integer('maksimum');
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
        Schema::drop('matura');
    }
}
