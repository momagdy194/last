<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,50),
        'product_id' => $faker->numberBetween(1, 500),
        'stars' => $faker->numberBetween(1, 5),
        'review' => $faker->paragraph(),
    ];
});
