<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePodInventoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pod_inventories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pod_api_id');
			$table->string('submeter');
			$table->integer('rack');
			$table->integer('earthing');
			$table->integer('alternative_source');
			$table->string('power_router_ip');
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
		Schema::drop('pod_inventories');
	}

}
