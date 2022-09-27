<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {

        $user = Auth::user();
        // $restaurant = Restaurant::findOrFail($user->id);

        // $data = [
        //     'user' => $user,
        //     'restaurant' => $restaurant,
        // ];

        return view('admin.home', compact('user'));
    }
}
