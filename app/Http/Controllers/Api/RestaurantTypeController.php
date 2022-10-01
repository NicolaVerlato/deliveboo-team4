<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RestaurantType;

class RestaurantTypeController extends Controller
{
    public function index() {

        $restauranttypes = RestaurantType::all();
        $data = [
            'success' => true,
            'results' => $restauranttypes
        ];

        return response()->json($data);
    }
}
