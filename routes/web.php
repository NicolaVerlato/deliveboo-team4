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
    Route::resource('dishes', 'DishController');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


