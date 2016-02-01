<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColoumnCharger extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('chargers', function(Blueprint $table)
		{
			$table->string('installed_date')->after('brand');
			$table->dropColumn('name');
		
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
		Schema::table('chargers', function(Blueprint $table)
		{
			$table->dropColumn('installed_date');
			$table->string('name')->after('brand');
		
		});
	}

}
