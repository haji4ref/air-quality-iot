<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Quality::class, function (Faker $faker) {
    return [
        'CO'         => $faker->randomFloat(2, 0.1, 6),
        'SO2'        => $faker->randomFloat(2, 0.1, 6),
        'NO2'        => $faker->randomFloat(2, 0.1, 6),
        'O3'         => $faker->randomFloat(2, 0.1, 6),
        'PM25'       => $faker->randomFloat(2, 0.1, 6),
        'PM10'       => $faker->randomFloat(2, 0.1, 6),
        'created_at' => $faker->dateTimeInInterval('- 2 months', '+2 minutes')
    ];
});
