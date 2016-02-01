<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUpsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pod_ups', function(Blueprint $table)
		{
			$table->string('installed_date')->after('brand');
			
		
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pod_ups', function(Blueprint $table)
		{
			$table->dropColumn('installed_date');
		
		
		});
	}

}
