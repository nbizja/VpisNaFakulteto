<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrijavaSrednjesolskaIzobrazba extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prijava_srednjesolska_izobrazba', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('id_kandidata');
            $table->boolean('ima_spricevalo')->default(0);
            $table->integer('id_nacina_zakljucka');
            $table->integer('id_srednje_sole');
            $table->integer('id_drzave');
            $table->integer('sifra_maturitetnega_predmeta');

            $table->string('ime_srednje_sole', 255);
            $table->date('datum_izdaje_spricevala');
            $table->timestamps();
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
        Schema::drop('prijava_srednjesolska_izobrazba');
    }
}
