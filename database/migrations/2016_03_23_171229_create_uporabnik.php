<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;


class CreateUporabnik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uporabnik', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('emso',50)->index()->nullable();
            $table->string('ime');
            $table->string('priimek');
            $table->string('username',50)->unique();
            $table->string('email');
            $table->string('password');
            $table->string('zeton');
            $table->string('remember_token');
            $table->string('vloga');
            $table->integer('obcina_rojstva')->unsigned()->nullable();
            $table->integer('id_drzave')->unsigned()->nullable();
            $table->integer('id_drzavljanstva')->unsigned()->nullable();
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
        Schema::drop('uporabnik');
    }
}
