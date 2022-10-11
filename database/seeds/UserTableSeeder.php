<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) { 
            $new_user = new User;

            $new_user->name = $faker->firstName();
            $new_user->lastname = $faker->lastName();
            $new_user->email = $faker->email();
            $new_user->iva = $faker->numberBetween(10000000000, 99999999999);
            $new_user->email_verified_at = NULL;
            $new_user->password = '$2y$10$EquTdJSR2GMrkH2HjMD43uButZpI2Oe6loYlJ1YZu49gyAvTD7x3e';

            $new_user->save();
        }
    }
}
