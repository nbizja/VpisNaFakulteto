<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenjavaGeslaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menjava_gesla', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_uporabnika');
            $table->string('novo_geslo');
            $table->string('zeton');
            $table->dateTime('veljavnost');
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
        Schema::drop('menjava_gesla');
    }
}
