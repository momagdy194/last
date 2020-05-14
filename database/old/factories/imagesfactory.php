<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\image;
use Faker\Generator as Faker;

$factory->define(image::class, function (Faker $faker) {
    return [

        'url'=>$faker->imageUrl(800,600),
        'product_id'=>$faker->numberBetween(1,500)
    ];
});
