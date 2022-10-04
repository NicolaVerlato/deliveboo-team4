<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;

class DishController extends Controller
{
    public function index() {
        $dishes = Dish::all();
        $data = [
            'success' => true,
            'results' => $dishes
        ];

        return response()->json($data);
    }

    public function show($id) {
        $dish = Dish::where('id', '=', $id)->get();

        if($dish) {
            $data = [
                'success' => true,
                'results' => $dish
            ];
        } else {
            $data = ['success' => false];
        };
        
        return response()->json($data);
    }
}
