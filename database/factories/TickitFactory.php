<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,50),
        'order_id' => $faker->numberBetween(1, 50),
        'title' => $faker->sentence,
        'message' => $faker->paragraph,
        'status' => $faker->randomElement(['pending','closed','waiting']),
        'tickit_type_id' => $faker->numberBetween(1,3),
    ];
});
