<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffPodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('off_pods', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pod_id');
			$table->string('state');
			$table->string('from_time');
			$table->integer('schedule_id');
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
		Schema::drop('off_pods');
	}

}
