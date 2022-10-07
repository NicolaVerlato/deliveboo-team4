<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Type;
use App\RestaurantType;
use App\Dish;

class RestaurantController extends Controller
{
    public function index() {
        
        $restaurants = Restaurant::all();
        $type = Type::all();
        $restauranttypes = RestaurantType::all();
        $dishes = Dish::all();
        $data = [
            'success' => true,
            'results' => $restaurants,
            'type' => $type,
            'data' => $restauranttypes,
            'dishes' => $dishes
        ];

        return response()->json($data);
    }

    public function showRestaurant($slug) {
        $restaurant = Restaurant::where('slug', '=', $slug)->first();


        if($restaurant) {
            $data = [
                'success' => true,
                'results' => $restaurant
            ];
        } else {
            $data = ['success' => false];
        };
        
        return response()->json($data);
    }
    public function show($slug) {
        $restaurant = Restaurant::where('slug', '=', $slug)->first();

        if($restaurant) {
            $data = [
                'success' => true,
                'results' => $restaurant
            ];
        } else {
            $data = ['success' => false];
        };
        
        return response()->json($data);
    }
}
