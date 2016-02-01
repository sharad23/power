<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePodScheduleExceptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pod_schedule_exceptions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pod_id');
			$table->string('timespan');
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
		Schema::drop('pod_schedule_exceptions');
	}

}
