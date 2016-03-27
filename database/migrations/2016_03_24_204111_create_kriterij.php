<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKriterij extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriterij', function(BluePrint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_programa')->unsigned();
            $table->string('id_elementa');
            $table->decimal('utez', 5, 2); //decimal, ker je v procentih
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
        Schema::drop('kriterij');
    }
}
