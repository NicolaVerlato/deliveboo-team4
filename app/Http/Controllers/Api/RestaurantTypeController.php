<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RestaurantType;
use Illuminate\Support\Str;

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
    public function test($filter) {
        $singleFilter = [];
        // foreach ($filter as $key => $value) {
        //     array_push($test, $value);
        // }
        for ($i=0; $i < Str::length($filter); $i++) { 
            if($filter[$i] === ',') {

            } else {
                array_push($singleFilter, $filter[$i]);
            }
        }
        $allRes = [];
        $test = [];
        foreach ($singleFilter as $key => $filter) {
            $filteredRestaurant = RestaurantType::where('type_id', '=', $filter)->get();
            array_push($allRes, $filteredRestaurant);
            foreach ($allRes as $key => $value) {
                $check = 0;
                array_push($test, $value[$key]);
                // if(in_array($value[$key]['type_id'] ,$filter)){
                //     ++$checking;
                // }
            }
            // if($checking == count($singleFilter)){
            //     $filered_restaurants[] = $allRes;
            // }
        }


        $data = [
            'success' => true,
            'results' => $test,
        ];
        return response()->json($data);
    }
}
