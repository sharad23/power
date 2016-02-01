<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PodInventoriesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			PodInventory::create([

				 'pod_api_id' => rand(21,30),
				 'submeter' => rand(0,1),
				 'earthing' => rand(0,1),
				 'alternative_source' => rand(0,1),
				 'power_router' => 1,
				 'power_router_ip' => $faker->ipv4

			]);
		}
	}

}