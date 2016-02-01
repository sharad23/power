<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePodBatteryInstallLog extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('pod_battery_install_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pod_battery_id')->unsigned()->index();
			$table->foreign('pod_battery_id')->references('id')->on('pod_batteries')->onDelete('cascade');
			$table->integer('visit_id')->unsigned()->index();
			$table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
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
		Schema::drop('pod_battery_install_log');
	}

}
