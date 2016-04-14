<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVnosVeljavenDrzavljanstvo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drzavljanstvo', function (Blueprint $table) {
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
        Schema::table('drzavljanstvo', function (Blueprint $table) {
            $table->dropColumn('vnos_veljaven');
        });
    }
}
