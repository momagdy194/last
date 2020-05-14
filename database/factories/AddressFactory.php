<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'street_name' =>$faker->streetName,
        'street_number' => $faker->numberBetween(1,200),
        'city' => $faker->city,
        'state' => $faker->state,
        'country' => $faker->country,
        'post_code' => $faker->postcode,
    ];
});
