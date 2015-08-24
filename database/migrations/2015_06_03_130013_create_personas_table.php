<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->integer('assignee_id', false, true);
			$table->string('avatarImg');
			$table->string('age');
			$table->enum('gender', ['male', 'female', 'other']);
			$table->string('occupation');
			$table->string('nationality');
			$table->enum('marital_status', ['single', 'in a relationship', 'long-term relationship', 'married', 'widowed', 'divorced', 'other']);
			$table->string('quote');
			$table->string('personality');
			$table->string('skills');
			$table->string('needs');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('personas');
	}

}
