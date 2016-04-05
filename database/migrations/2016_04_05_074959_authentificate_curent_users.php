<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthentificateCurentUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$users= DB::table('users')->get();
		foreach ($users as $user){
			DB::table('users')
			->where('id', $user->id)
			->update(['status_enable' => 1]);
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
