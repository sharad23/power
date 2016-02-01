<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffPodLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('off_pod_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('pod_id');
			$table->string('from_time');
			$table->string('to_time');
			$table->string('state');
			$table->string('schedule_from_time');
			$table->string ('schedule_to_time');
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
		Schema::drop('off_pod_logs');
	}

}
