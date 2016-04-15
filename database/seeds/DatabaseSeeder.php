<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use UsersSeeder as UsersSeeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		DB::table('users')->insert([
		'name' => 'admin',
		'email' => 'admin.dmk@dmk-ebusiness.de',
		'password' => bcrypt('testtest'),
		'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
		'status_enable' => 1,
		'is_Admin' => 1,
		'last_Login' => \Carbon\Carbon::now()->toDateTimeString()
		]);
		
		// $this->call('UsersSeeder');
	}

}
