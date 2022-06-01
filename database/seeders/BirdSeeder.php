<?php

namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class BirdSeeder extends CsvSeeder
{
	public function __construct()
	{
		$this->table = 'birds';
        $this->csv_delimiter = ';';
		$this->filename = base_path().'/database/seeds/birds_csv.csv';
	}
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		// Recommended when importing larger CSVs
		DB::disableQueryLog();

		// Uncomment the below to wipe the table clean before populating
		// DB::table($this->table)->truncate();

		parent::run();
	}
}
