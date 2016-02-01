<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePodBatteryVisitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pod_battery_report_visit', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pod_battery_id')->unsigned()->index();
			$table->foreign('pod_battery_id')->references('id')->on('pod_batteries')->onDelete('cascade');
			$table->integer('visit_id')->unsigned()->index();
			$table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
			$table->string('water_level');
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
		Schema::drop('pod_battery_report_visit');
	}

}
