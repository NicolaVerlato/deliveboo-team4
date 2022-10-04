<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Type;
use App\RestaurantType;
use Illuminate\Support\Str;

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
    public function show($id) {
        $splitFilter = [];
        $restauranttypes = [];
        $sos = [];
        $test = [];
        $baba = [];
        $restaurants = [];

        if (Str::length($id) > 1) {
            for ($i=0; $i < Str::length($id); $i++) { 
                if($id[$i] == '-') {
                    
                } else {
                    // array_push($splitFilter, $id[$i]);
                    $splitFilter[] = $id[$i];
                }
            }
        }
        $restauranttypes[] = RestaurantType::where('type_id', '=', $id)->get();
        $singleFilter = [];
        // foreach ($restauranttypes as $key => $value) {
            // array_push($singleFilter, $value);
            // $singleFilter[] = $value;
        // }
        if (count($splitFilter) <= 1) {
            foreach ($restauranttypes as $secondKey => $secondValue) {
                array_push($baba, $restauranttypes[$secondKey]);
                // $baba[] = $secondValue[$secondKey]->restaurant_id;
                // array_push($baba, $secondValue[$secondKey]->restaurant_id);
                foreach ($secondValue as $key => $value) {
                    // dd($value->restaurant_id);
                    array_push($restaurants, Restaurant::where('id', '=', $value->restaurant_id)->get());
                }
                // $baba[] = $secondValue[$secondKey]->restaurant_id;
                // $restaurants->push(Restaurant::where('id', '=', $secondValue[$secondKey]->restaurant_id)->get());
            }
        }

        if (count($splitFilter) === 0 ) {
            $restauranttypes = RestaurantType::where('type_id', '=', $id)->get();
        } else {
            // for ($i=0; $i < count($splitFilter); $i++) { 
                //     // dd($splitFilter[$i]);
                //     // array_push($sos, $splitFilter[$i]);
                //     $sos[] = RestaurantType::where('type_id', '=', $splitFilter[$i])->get();
                //     // dd($restauranttypes);
                // }
                foreach ($splitFilter as $key => $value) {
                    $sos[] = RestaurantType::where('type_id', '=', $value)->get();
                    // dd(RestaurantType::where('type_id', '=', $splitFilter[1])->get());
                }
                // dd($sos);
        }
        // for ($i=0; $i < count($sos); $i++) { 
        //     // in sos ho tutti i filtri selezionati
        //     $test[] = $sos[$i];
        //     // $test[$i]->toArray();
        //     $newemployees = $sos[$i]->toJson();
        //     $newemp = [];---
        //     $ciao = json_decode($newemployees);
        //     array_push($newemp, $ciao);
        //     // $newemp[] .= $ciao;
        //     // $newemp[] = json_decode($newemployees);
        //     // dd($newemployees);
        //     dd($newemp);
        //     $restaurants[] = dd(Restaurant::where('id', '=', $newemp[$i]->restaurant_id)->get());
            
        // }
        if (count($sos) > 0) {
            $restaurants = [];
            foreach ($sos as $key => $value) {
                $test[] = $value[$key];
                foreach ($test as $secondKey => $secondValue) {
                    $secondTest[] = $secondValue->restaurant_id;
                    $restaurants[] = Restaurant::where('id', '=', $secondValue->restaurant_id)->get();
                    // dd($restaurants);
                }
            }
            // dd($test);
        }

        $data = [
            'success' => true,
            'results' => $restaurants,
            'filteredresults' => $sos,
            'data' => $restauranttypes
        ];

        return response()->json($data);
    }
}
