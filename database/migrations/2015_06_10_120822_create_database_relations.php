<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabaseRelations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bmc_personas', function ($table) {
		    $table->foreign('bmc_id')->references('id')->on('bmcs');
		    $table->foreign('persona_id')->references('id')->on('personas');
		});
		
		Schema::table('bmcs', function ($table) {
			$table->foreign('project_id')->references('id')->on('projects');
		});
		
		Schema::table('notices', function ($table) {
			$table->foreign('bmc_id')->references('id')->on('bmcs');
			$table->foreign('canvas_box_id')->references('id')->on('canvas_boxes');
		});
		
		Schema::table('projects', function ($table) {
			$table->foreign('assignee_id')->references('id')->on('users');
		});
		
		Schema::table('project_members', function ($table) {
			$table->foreign('project_id')->references('id')->on('projects');
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bmc_personas', function ($table) {
		    $table->dropForeign('bmc_personas_bmc_id_foreign');
		    $table->dropForeign('bmc_personas_persona_id_foreign');
		});
		
		Schema::table('bmcs', function ($table) {
			$table->dropForeign('bmcs_project_id_foreign');
		});
		
		Schema::table('notices', function ($table) {
			$table->dropForeign('notices_bmc_id_foreign');
			$table->dropForeign('notices_canvas_box_id_foreign');
		});
		
		Schema::table('projects', function ($table) {
			$table->dropForeign('projects_assignee_id_foreign');
		});
		
		Schema::table('project_members', function ($table) {
			$table->dropForeign('project_members_project_id_foreign');
			$table->dropForeign('project_members_user_id_foreign');
		});
	}

}
