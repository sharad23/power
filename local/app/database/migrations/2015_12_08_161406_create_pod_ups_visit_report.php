<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePodUpsVisitReport extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('pod_ups_visit_report', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pod_ups_id')->unsigned()->index();
			$table->foreign('pod_ups_id')->references('id')->on('pod_ups')->onDelete('cascade');
			$table->integer('visit_id')->unsigned()->index();
			$table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
			$table->string('main_input_voltage');
			$table->string('output_voltage_bypass');
			$table->string('output_voltage_backup');
			$table->string('charging_ampere');
			$table->string('discharging_ampere');
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
		//
		Schema::drop('pod_ups_visit_report');
	}

}
