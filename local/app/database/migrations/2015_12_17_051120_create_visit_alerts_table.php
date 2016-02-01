<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisitAlertsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visit_alerts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id');			
			$table->string('visit_id');		
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
		Schema::drop('visit_alerts');
	}

}
