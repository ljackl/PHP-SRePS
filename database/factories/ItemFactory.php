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
    $categoryValues = ['one', 'two', 'three'];

    return [
        'name' => $faker->unique()->word(),
        'description' => $faker->sentence,
        'category' => $categoryValues[rand(0,2)],
        'stock' => mt_rand(1, 100),
        'cost' => (mt_rand(1*10, 100*10) / 10),
        'created_at' => $faker->dateTimeThisYear,
    ];
});
