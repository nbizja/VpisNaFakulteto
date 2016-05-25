<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdPogojaMaturitetniUspehOcene34LetnikaToKriterij extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kriterij', function (Blueprint $table) {
            $table->boolean('ocene_34_letnika')->default(true)->nullable();
            $table->boolean('maturitetni_uspeh')->default(true)->nullable();
            $table->boolean('id_pogoja')->default(true)->nullable();
            $table->dropColumn('id_programa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kriterij', function (Blueprint $table) {
            $table->dropColumn('ocene_34_letnika');
            $table->dropColumn('maturitetni_uspeh');
            $table->dropColumn('id_pogoja');
            $table->boolean('id_programa')->default(true)->nullable();
        });
    }
}
