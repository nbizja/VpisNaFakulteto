<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatumOddajePrijave extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uporabnik', function(Blueprint $table) {
            $table->date('datum_oddaje_prijave')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uporabnik', function(Blueprint $table) {
            $table->dropColumn('datum_oddaje_prijave');
        });
    }
}
