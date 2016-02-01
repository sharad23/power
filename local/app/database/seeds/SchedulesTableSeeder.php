<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SchedulesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Schedule::create([
                     
                  'from_time' => $faker->time($format = 'H:i:s', $max = 'now'),
                  'to_time' => $faker->time($format = 'H:i:s', $max = 'now'),
                  'group_id' => rand(1,10),  
                  'day' => rand(1,7)    
			]);
		}
	}

}