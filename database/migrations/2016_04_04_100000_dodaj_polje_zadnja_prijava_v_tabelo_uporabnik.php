<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DodajPoljeZadnjaPrijavaVTabeloUporabnik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uporabnik', function ($table) {
            $table->timestamp('zadnja_prijava')->nullable()->after('vloga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uporabnik', function ($table) {
            $table->dropColumn('zadnja_prijava');
        });
    }
}
