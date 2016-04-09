<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSifraToStudijskiProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Schema::table('studijski_program', function (Blueprint $table) {
            $table->string('sifra');
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
        Schema::table('studijski_program', function (Blueprint $table) {
            $table->dropColumn('sifra');
        });
    }
}
