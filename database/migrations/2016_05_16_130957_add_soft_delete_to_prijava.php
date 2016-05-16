<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeleteToPrijava extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prijava', function(BluePrint $table) {
            $table->engine = 'InnoDB';

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prijava', function(BluePrint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
