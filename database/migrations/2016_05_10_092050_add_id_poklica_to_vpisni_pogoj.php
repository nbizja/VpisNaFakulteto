<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdPoklicaToVpisniPogoj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vpisni_pogoj', function (Blueprint $table) {
            $table->string('id_poklica')->nullable();
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
            $table->dropColumn('id_poklica');
        });
    }
}
