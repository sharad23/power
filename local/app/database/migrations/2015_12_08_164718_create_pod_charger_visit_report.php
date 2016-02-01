<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePodChargerVisitReport extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('pod_charger_visit_report', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pod_charger_id')->unsigned()->index();
			$table->foreign('pod_charger_id')->references('id')->on('chargers')->onDelete('cascade');
			$table->integer('visit_id')->unsigned()->index();
			$table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
			$table->string('condition');
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
		Schema::drop('pod_charger_visit_report');
	}

}
