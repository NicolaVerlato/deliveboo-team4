<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index() {

        $user = Auth::user();
        $now = Carbon::now();
        $restaurantLink = Restaurant::where('user_id', '=', $user->id)->first();

        $data = [
            'user' => $user,
            'now' => $now,
            'restaurantLink' => $restaurantLink
        ];

        return view('admin.home', $data);
    }
}
