<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBmcsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bmcs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->enum('status', ['approved', 'inWork', 'deleted', 'rejected']);
			$table->integer('version');
			$table->integer('project_id', false, true);
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
		Schema::drop('bmcs');
	}

}
