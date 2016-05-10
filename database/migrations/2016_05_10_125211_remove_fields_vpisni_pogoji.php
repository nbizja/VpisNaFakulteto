<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFieldsVpisniPogoji extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vpisni_pogoj', function (Blueprint $table) {
            $table->dropColumn('stevilo_sprejetih');
            $table->dropColumn('stevilo_vpisnih_mest_tujci');
            $table->dropColumn('stevilo_sprejetih_tujci');
            $table->dropColumn('stevilo_mest_po_omejitvi_tujci');
            $table->dropColumn('omejitev_vpisa_tujci');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
