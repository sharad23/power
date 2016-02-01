<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePodSubmeterVisitReport extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pod_submeter_visit_report', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pod_inventory_id')->unsigned()->index();
			$table->foreign('pod_inventory_id')->references('id')->on('pod_inventories')->onDelete('cascade');
			$table->integer('visit_id')->unsigned()->index();
			$table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
			$table->string('reading');
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
		Schema::drop('pod_submeter_visit_report');
	}

}
