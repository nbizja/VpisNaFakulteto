<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeSkrbnikNullableInVisokosolskiZavod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Schema::table('visokosolski_zavod', function (Blueprint $table) {
            $table->integer('id_skrbnika')->unsigned()->nullable()->change();
        });
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visokosolski_zavod', function (Blueprint $table) {
            $table->integer('id_skrbnika')->nullable()->change();
        });
    }
}
