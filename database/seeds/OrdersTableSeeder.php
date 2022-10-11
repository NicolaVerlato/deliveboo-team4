<?php

use Illuminate\Database\Seeder;
use App\Order;
use Faker\Generator as Faker;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 2000; $i++) { 
            $new_order = new Order;
            
            $new_order->customer_name = $faker->name();
            $new_order->customer_email = $faker->email();
            $new_order->customer_address = $faker->streetAddress();
            $new_order->order_total = $faker->numberBetween(15, 100);
            $new_order->restaurant_id = $faker->randomDigitNotNull();
            $new_order->confirmed = 1;
            $new_order->created_at = $faker->dateTimeThisYear();
            $new_order->updated_at = $faker->dateTimeThisYear();

            $new_order->save();
        }

    }
}
