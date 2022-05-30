<?php

namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class ShapeSeeder extends CsvSeeder
{
	public function __construct()
	{
		$this->table = 'shapes';
		$this->filename = base_path().'/database/seeds/shapes_csv.csv';
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
