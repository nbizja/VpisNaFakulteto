<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeSkrbnikNullableInVisokosolskiZavod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::statement('ALTER TABLE `visokosolski_zavod` MODIFY `id_skrbnika` INTEGER UNSIGNED NULL;');
		DB::statement('UPDATE `visokosolski_zavod` SET `id_skrbnika` = NULL WHERE `id_skrbnika` = 0;');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::statement('UPDATE `visokosolski_zavod` SET `id_skrbnika` = 0 WHERE `id_skrbnika` IS NULL;');
		DB::statement('ALTER TABLE `visokosolski_zavod` MODIFY `id_skrbnika` INTEGER UNSIGNED NOT NULL;');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
