<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;


/**
 * Seeds database with data from specified csv file.
 *
 * Names of data files must exactly match the names of tables.
 * The leading line of each data file must be a header.
 * Names of colums in data file must exactly match colums in database
 * table.
 */
class VisokosolskiZavodSeeder extends CsvSeeder
{
    /**
     * Path to a directory containing data files.
     */
    const DATA_DIR = '/database/seeds/sifranti/';
    const FILE_NAME = 'visokosolski_zavod';

    /**
     * Extension of datafiles in `DATA_DIR`, including the leading
     * dot.'
     */
    const DATA_EXTENSION = '.csv';

    /**
     * Initialize the DatabaseSeeder object. Searches for all data
     * files in `DATA_DIR` and saves their paths in `$file_list`.
     *
     * @return void
     */
     public function __construct()
     {
         $this->data_file = NULL;
         $path = base_path() . self::DATA_DIR . self::FILE_NAME . self::DATA_EXTENSION;
         if (is_file($path )) {
             $this->data_file = $path;
         }
     }

    /**
     * Seeds a table for file `FILE_NAME`.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        if (!is_null($this->data_file)) {
            $this->table = self::FILE_NAME;
            $this->filename = $this->data_file;
			DB::table($this->table)->truncate();
            parent::run();
        } else {
            throw new Exception("$this->data_file ni veljavna datoteka.");
        }

        DB::table('visokosolski_zavod')->where('id','63')->update(array('id_skrbnika' => 4));
    }
}

