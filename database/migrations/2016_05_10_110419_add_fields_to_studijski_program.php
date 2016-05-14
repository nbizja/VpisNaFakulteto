<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToStudijskiProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studijski_program', function (Blueprint $table) {
            $table->integer('stevilo_sprejetih')->nullable();
            $table->integer('stevilo_vpisnih_mest_tujci')->nullable();
            $table->integer('stevilo_sprejetih_tujci')->nullable();
            $table->integer('stevilo_mest_po_omejitvi_tujci')->nullable();
            $table->boolean('omejitev_vpisa_tujci')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('studijski_program', function (Blueprint $table) {
            $table->dropColumn('stevilo_sprejetih');
            $table->dropColumn('stevilo_vpisnih_mest_tujci');
            $table->dropColumn('stevilo_sprejetih_tujci');
            $table->dropColumn('stevilo_mest_po_omejitvi_tujci');
            $table->dropColumn('omejitev_vpisa_tujci');
        });
    }
}
