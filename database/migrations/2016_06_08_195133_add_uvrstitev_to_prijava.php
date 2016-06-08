<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUvrstitevToPrijava extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('prijava', function(Blueprint $table) {
            $table->integer('uvrstitev')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('prijava', function(Blueprint $table) {
            $table->dropColumn('uvrstitev');
        });
    }
}
