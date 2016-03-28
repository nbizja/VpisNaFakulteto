<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;


/**
 * Seeds database with data from csv files.
 *
 * Names of data files must exactly match the names of tables.
 * The leading line of each data file must be a header.
 * Names of colums in data file must exactly match colums in database
 * table.
 */
class DatabaseSeeder extends CsvSeeder
{
    /**
     * Path to a directory containing data files.
     */
    const DATA_DIR = '/database/seeds/sifranti/';

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
         $this->file_list = array_filter(
             glob(base_path() . self::DATA_DIR . '*' . self::DATA_EXTENSION),
             'is_file');
     }

    /**
     * Seeds a table for each data file in `DATA_DIR`.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        foreach ($this->file_list as $path) {
            $this->table = basename($path, self::DATA_EXTENSION);
            $this->filename = $path;

            parent::run();
        }
    }
}

