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
        $restaurants_address = ['Via Stella, 22', 'Via delle foglie, 12', 'Via hokkaido, 43', 'Via hokkaido, 44', 'Piazza del popolo, 26', 'Via Giuseppe Garibaldi, 6', 'Via del salice, 9', 'Via capitalistica, 4', 'Vicolo corto, 1', 'Piazzale della vittoria, 34' ];
        $restaurants_name = ['Osteria Francescana', 'Rosso pomodoro', 'Ippudo', 'Sushi mentai', 'Ganesha', 'Shiva', 'Pizza al metro', 'McDonald', 'MCTuriddu', 'Cucina Italiana 90%'];
        for ($i=0; $i < 10; $i++) { 
            $new_restaurant = new Restaurant();

            $new_restaurant->name = $restaurants_name[$i];
            $new_restaurant->address = $restaurants_address[$i];
            $new_restaurant->slug = Str::slug($new_restaurant->name, '-');
            $new_restaurant->user_id = $i + 1;
            $new_restaurant->save();
        }

    }
}
