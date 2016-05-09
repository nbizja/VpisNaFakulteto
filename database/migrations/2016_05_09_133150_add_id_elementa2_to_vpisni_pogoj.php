<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdElementa2ToVpisniPogoj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vpisni_pogoj', function (Blueprint $table) {
            $table->string('id_elementa2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vpisni_pogoj', function (Blueprint $table) {
            $table->dropColumn('id_elementa2');
        });
    }
}
