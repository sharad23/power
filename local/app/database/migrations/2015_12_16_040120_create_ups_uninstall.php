<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpsUninstall extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('pod_ups_uninstall_log', function(Blueprint $table)
		{

			$table->increments('id');
			$table->integer('ups_id')->unsigned();
			$table->foreign('ups_id')->references('id')->on('pod_ups')->onDelete('cascade');
			$table->integer('visit_id')->unsigned();
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
		Schema::drop('pod_ups_uninstall_log');
	}

}
