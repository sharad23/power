<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class OffPodsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			OffPod::create([

				    'pod_id' => rand(1,5),
				    'state' => array_rand(array('X','0','1','2')),
				    'from_time' => $faker->time($format = 'H:i:s', $max = 'now')

			]);
		}
	}

}