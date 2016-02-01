<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePodBatteriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pod_batteries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('installed_date');
			$table->string('capacity');
			$table->integer('pod_inventory_id');
			$table->string('brand');
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
		Schema::drop('pod_batteries');
	}

}
