<?php

use App\Quality;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class QualityTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $diff = Carbon::now()->diffInHours(Carbon::now()->subMonth(2));

        for($i = 0; $i < $diff +10; $i ++) {
            Quality::create([
                'CO'         => $faker->randomFloat(2, 0.1, 6),
                'SO2'        => $faker->randomFloat(2, 0.1, 6),
                'NO2'        => $faker->randomFloat(2, 0.1, 6),
                'O3'         => $faker->randomFloat(2, 0.1, 6),
                'PM25'       => $faker->randomFloat(2, 0.1, 6),
                'PM10'       => $faker->randomFloat(2, 0.1, 6),
                'created_at' => Carbon::now()->subMonth(2)->addHour($i)->addSecond($faker->numberBetween(0, 10))
            ]);
        }

    }
}
