<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'description'=>$faker->paragraph(6),
        'unit'=>$faker->randomElement(['kg','m','qty',]),
        'price'=>$faker->randomNumber(2),
        'total'=>$faker->numberBetween(2,250),
        'category_id'=>$faker->numberBetween(1,50)

        ];
});
