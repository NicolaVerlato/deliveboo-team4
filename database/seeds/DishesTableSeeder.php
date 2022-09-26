<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Dish;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 5; $i++) { 
            $new_dish = new Dish();

            $new_dish->name = $faker->name();
            $new_dish->description = $faker->paragraph();
            $new_dish->price = rand(5, 50000);
            $new_dish->is_visible = rand(0, 1);
            $new_dish->restaurant_id = 1;
            $new_dish->save();
        }
    }
}
