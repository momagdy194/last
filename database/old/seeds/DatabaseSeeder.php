<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

     //   factory(\App\User::class, 500)->create();
        factory(\App\addrees::class, 500)->create();
        factory(\App\image::class, 500)->create();
        factory(\App\Product::class, 500)->create();
        factory(\App\Review::class, 500)->create();
        factory(\App\categories::class, 50)->create();
        factory(\App\Tag::class, 150)->create();
       // factory(\App\Tiket::class,150)->create();
    }
}
