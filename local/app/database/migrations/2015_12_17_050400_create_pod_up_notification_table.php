<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePodUpNotificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pod_up_notifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id');			
			$table->string('pod_id');		
			$table->string('descriptions');		
			$table->string('notification_status');
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
		Schema::drop('pod_up_notifications');
	}

}
