<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Maker;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
                //don't check for foreign keys
                DB::statement('SET FOREIGN_KEY_CHECKS = 0');
                //will first delete data, before add new
                Maker::truncate();
		Model::unguard();

		// $this->call('UserTableSeeder');
                $this->call('MakerSeed');
                $this->call('VehicleSeed');
	}

}
