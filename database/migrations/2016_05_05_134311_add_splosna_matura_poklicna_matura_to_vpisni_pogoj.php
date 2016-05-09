<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSplosnaMaturaPoklicnaMaturaToVpisniPogoj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vpisni_pogoj', function (Blueprint $table) {
            $table->boolean('splosna_matura')->default(true)->nullable();
            $table->boolean('poklicna_matura')->default(true)->nullable();
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
            $table->dropColumn('poklicna_matura');
            $table->dropColumn('splosna_matura');
        });
    }
}
