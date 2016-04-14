<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVnosVeljavenStudijskiProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('studijski_program', function (Blueprint $table) {
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
        Schema::table('studijski_program', function (Blueprint $table) {
            $table->dropColumn('vnos_veljaven');
        });
    }
}
