<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Item::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word(),
        'description' => $faker->sentence,
        'stock' => mt_rand(1, 100),
        'cost' => (mt_rand(1*10, 100*10) / 10),
        'created_at' => $faker->dateTimeThisYear,
    ];
});
