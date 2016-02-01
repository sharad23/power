<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		
		$this->call('GroupsTableSeeder');
		$this->call('SchedulesTableSeeder');
		$this->call('PodsTableSeeder');
		$this->call('PodScheduleGroupsTableSeeder');
		$this->call('PodScheduleExceptionsTableSeeder');
		$this->call('GraceTimesTableSeeder');
		$this->call('OffPodsTableSeeder');
	}

}
