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
        $this->call(UserTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        // $this->call(RestaurantsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
    }
}
