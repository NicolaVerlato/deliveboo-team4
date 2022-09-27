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
        $this->call(RestaurantsTableSeeder::class);
        $this->call(DishesTableSeeder::class);
        $this->call(TypesTableSeeder::class);
    }
}
