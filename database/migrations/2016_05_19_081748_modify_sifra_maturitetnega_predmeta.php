<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifySifraMaturitetnegaPredmeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prijava_srednjesolska_izobrazba', function(Blueprint $table) {
            $table->string('sifra_maturitetnega_predmeta', 5)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prijava_srednjesolska_izobrazba', function(Blueprint $table) {
            $table->integer('sifra_maturitetnega_predmeta', 5)->change();
        });
    }
}
