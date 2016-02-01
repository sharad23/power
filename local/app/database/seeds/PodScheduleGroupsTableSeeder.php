<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PodScheduleGroupsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			PodScheduleGroup::create([

				  'pod_id' => rand(1,10),
				  'group_id' =>rand(1,10)

			]);
		}
	}

}