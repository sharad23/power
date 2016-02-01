<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class VisitsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Visit::create([
                     
                  'type' => rand(0,1),
                  'visit_date' => $faker->time($format = 'H:i:s', $max = 'now'),
                  'parent_id' => 0,  
                  'purpose' => $faker->paragraph($nbSentences = 3),
                  'remarks' => $faker->paragraph($nbSentences = 3)   
			]);
		}
	}

}