<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/restauranttype', 'Api\RestaurantTypeController@index');

Route::get('/types', 'Api\TypeController@index');
Route::get('/restaurants', 'Api\RestaurantController@index');
Route::get('/{slug}', 'Api\RestaurantController@showRestaurant');
Route::get('/dishes', 'Api\DishController@index');
Route::get('/dishes/{id}', 'Api\DishController@show');
Route::get('/restaurants/{slug}', 'Api\RestaurantController@show');
