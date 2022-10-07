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
            // if($checking == count($singleFilter)){
                //     $filered_restaurants[] = $allRes;
                // }
            }
            foreach ($allRes as $firstKey => $value) {
                $check = 0;
                
                foreach ($value as $key => $ciaone) {
                    foreach ($singleFilter as $key => $filtroSingolo) {
                        // if($ciaone['type_id'] == $filtroSingolo){
                        //     ++$checking;
                            
                        // }
                        array_push($test, $ciaone['type_id']);
                    }
                }
                // if($checking == count($allRes['type_id'])){
                //     $filered_apartment_service[] = $value;
                // }
            }


        $data = [
            'success' => true,
            'results' => $test,
        ];
        return response()->json($data);
    }
}
