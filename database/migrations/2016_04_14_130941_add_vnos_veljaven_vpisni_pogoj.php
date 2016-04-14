<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVnosVeljavenVpisniPogoj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vpisni_pogoj', function (Blueprint $table) {
            $table->boolean('vnos_veljaven')->default(true)->nullable();
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
            $table->dropColumn('vnos_veljaven');
        });
    }
}
