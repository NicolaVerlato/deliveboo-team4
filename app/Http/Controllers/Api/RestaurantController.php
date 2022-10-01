<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Type;
use App\RestaurantType;

class RestaurantController extends Controller
{
    public function index() {

        $restaurants = Restaurant::all();
        $type = Type::all();
        $restauranttypes = RestaurantType::all();
        $data = [
            'success' => true,
            'results' => $restaurants,
            'type' => $type,
            'data' => $restauranttypes
        ];

        return response()->json($data);
    }
}
