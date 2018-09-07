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

$factory->define(App\Sale::class, function (Faker $faker) {
    return [
        'sale' => (mt_rand(1*10, 20*10) / 10),
        'quantity' => mt_rand(1, 5),
        'created_at' => $faker->dateTimeThisYear,
        'item_id' => mt_rand(1, 200), // TODO: Get ID from Model
    ];
});
