<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertAdminInUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$users = DB::table('users')->count();
		if($users == 0){
			$password= bcrypt('testtest');
			DB::table('users')->insert(
				['name' => 'Admin']
			);
			DB::table('users')
			->where('id', '1')
			->update(['email'=>'admin.dmk@dmk-ebusiness.de',
				'password' => $password,
				'is_Admin' => '1',
				'status_enable' => '1',
				'last_Login'=>\Carbon\Carbon::now()->toDateTimeString() ]);
		}else{
			DB::table('users')
			->where('id', '1')
			->update(['is_Admin' => '1']);
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
