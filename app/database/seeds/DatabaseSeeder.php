<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		DB::table('service_user')->delete();
		DB::table('package_service')->delete();
		DB::table('package_user')->delete();
		$this->call('UserTableSeeder');
		$this->call('ServiceTableSeeder');
		$this->call('PackageTableSeeder');
		$this->call('SetUpSeeder');
	}

}
