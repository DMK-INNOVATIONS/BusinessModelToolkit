<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDefaultValueInUsersIsadmin extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		
		$users= DB::table('users')->get();
		foreach ($users as $user){
			DB::table('users')
			->where('id', $user->id)
			->update(['is_Admin' => 0,'last_Login'=>\Carbon\Carbon::now()->toDateTimeString() ]);
		}
		echo "updating with succes \n";
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
