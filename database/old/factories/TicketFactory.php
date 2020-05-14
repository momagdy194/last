<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tiket;
use Faker\Generator as Faker;

$factory->define(Tiket::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->numberBetween(1,500),
        'order_id'=>$faker->numberBetween(1,50),
        'title'=>$faker->sentence,
        'message'=>$faker->paragraph,
        'statues'=>$faker->randomElement(['pending','close','waiting']),
        'ticket_type_id'=>$faker->numberBetween(1,4)
    ];
});
