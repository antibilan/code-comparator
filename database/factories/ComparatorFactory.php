<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comparator;
use Faker\Generator as Faker;

$factory->define(Comparator::class, function (Faker $faker) {
    return [
        'code' => $faker->numberBetween($min = 10000000000, $max=17935111614),
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime(),
    ];
});
