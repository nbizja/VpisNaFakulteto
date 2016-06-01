<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSprejetColumnToPrijavaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prijava', function(Blueprint $table) {
            $table->tinyInteger('sprejet')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prijava', function(Blueprint $table) {
            $table->dropColumn('sprejet');
        });
    }
}
