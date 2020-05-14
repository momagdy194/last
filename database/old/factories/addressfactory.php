<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\addrees;
use Faker\Generator as Faker;

$factory->define(addrees::class, function (Faker $faker) {
    return [
        'street_name'=>$faker->streetName,
        'street_number'=>$faker->streetSuffix,
        'city'=>$faker->city,
        'state'=>$faker->state,
        'country'=>$faker->country,
        'post_code'=>$faker->postcode
    ];
});
