<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginBanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_ban', function(BluePrint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->ipAddress('ip');
            $table->string('username');
            $table->integer('fail_count')->unsigned();
            $table->dateTime('ban_expire')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('login_ban');
    }
}
