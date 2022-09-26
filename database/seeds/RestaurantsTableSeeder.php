<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $new_restaurant = new Restaurant();

        $new_restaurant->name = $faker->name();
        $new_restaurant->address = $faker->streetAddress();
        $new_restaurant->slug = Str::slug($new_restaurant->name, '-');
        $new_restaurant->save();
    }
}
