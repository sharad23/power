<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PodsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Pod::create([
                 
                 'pod_api_id' => $faker->randomDigit,
                 'schedule_type' => rand(0,1)
			
			]);
		}
	}

}