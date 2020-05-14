<?php

use App\Models\Address;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Review;
use App\Models\Tag;
use App\Models\Ticket;
use App\Models\User;
use Faker\Factory;
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
        factory(Address::class, 200)->create();
       factory(User::class , 50)->create();
      factory(Product::class, 500)->create();
      // factory(Image::class, 400)->create();
       factory(Review::class, 500)->create();
         factory(Category::class, 500)->create();
         factory(Ticket::class, 150)->create();
        factory(Tag::class, 200)->create();
    }
}
