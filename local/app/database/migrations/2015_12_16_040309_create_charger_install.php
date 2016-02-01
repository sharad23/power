<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargerInstall extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pod_charger_install_log', function(Blueprint $table)
		{

			$table->increments('id');
			$table->integer('charger_id')->unsigned();
			$table->foreign('charger_id')->references('id')->on('chargers')->onDelete('cascade');
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
		Schema::drop('pod_charger_install_log');
	}

}
