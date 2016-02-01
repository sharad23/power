<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PodBatteriesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			PodBattery::create([

				  'installed_date' => $faker->dateTime(),
				  'capacity' => '150',
				  'brand' => 'Duracell',
				  'pod_inventory_id' => rand(1,2)

			]);
		}
	}

}