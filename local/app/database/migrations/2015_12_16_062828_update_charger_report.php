<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateChargerReport extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('pod_charger_visit_report', function(Blueprint $table)
		{
			$table->string('charging_ampere')->after('visit_id');
			$table->dropColumn('condition');
		
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
		Schema::table('pod_charger_visit_report', function(Blueprint $table)
		{
			$table->dropColumn('charging_ampere');
			$table->string('condition')->after('visit_id');
		
		});
	}

}
