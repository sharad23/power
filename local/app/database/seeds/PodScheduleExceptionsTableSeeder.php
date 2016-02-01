<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PodScheduleExceptionsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			PodScheduleException::create([

				   'pod_id' => rand(1,10),
				   'timespan' => $faker->numberBetween($min = 1000, $max = 9000) 

			]);
		}
	}

}