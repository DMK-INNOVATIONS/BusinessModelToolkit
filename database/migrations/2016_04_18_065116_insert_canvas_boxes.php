<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertCanvasBoxes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$canvas_boxes = DB::table('canvas_boxes')->count();
		if($canvas_boxes == 0){
			DB::table('canvas_boxes')->insert(
				['title' => 'Key Partners']
			);
			DB::table('canvas_boxes')->insert(
				['title' => 'Key Activities']
			);
			DB::table('canvas_boxes')->insert(
				['title' => 'Key Ressources']
			);
			DB::table('canvas_boxes')->insert(
				['title' => 'Value Propositions']
			);
			DB::table('canvas_boxes')->insert(
				['title' => 'Customer Relationships']
			);
			DB::table('canvas_boxes')->insert(
				['title' => 'Channels']
			);
			DB::table('canvas_boxes')->insert(
				['title' => 'Customer Segments']
			);
			DB::table('canvas_boxes')->insert(
				['title' => 'Cost Structure']
			);
			DB::table('canvas_boxes')->insert(
				['title' => 'Revenue Streams']
			);
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
