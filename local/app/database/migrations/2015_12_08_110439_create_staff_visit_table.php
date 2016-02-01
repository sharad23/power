<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;

class CreateStaffVisitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	
	public function up()
	{  

		//$tableName = 'your_table';
        //$databaseName = DB::connection('intranet')->getDatabaseName();
		Schema::create('staff_visit', function(Blueprint $table)
		{

			//$databaseName = DB::connection('intranet')->getDatabaseName();
			//$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('staff_id')->unsigned();
			$table->foreign('staff_id')->references('id')->on(new Expression('another_db.staffs'));
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
		Schema::drop('staff_visit');
	}

}
