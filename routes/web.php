<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// If the user is logged, show the admin pages
Route::middleware('auth')
->name('admin.')
->namespace('Admin')
->prefix('admin')
->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('restaurants', 'RestaurantController');
    Route::resource('dishes', 'DishController');
});

Auth::routes();

Route::resource('/orders', 'OrderController');
Route::get('/orders/create/{price}/{id}/{allDishesIds}/{quantity}', 'OrderController@create');

Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');
