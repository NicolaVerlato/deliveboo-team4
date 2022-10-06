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

        // prendo dati utente loggato
        $user = Auth::user();
        $now = Carbon::now();
        // controllo se l'utente loggato ha già un ristorante
        $restaurantLink = Restaurant::where('user_id', '=', $user->id)->first();

        $data = [
            'user' => $user,
            'now' => $now,
            // e lo passo per la dashboard
            'restaurantLink' => $restaurantLink
        ];

        return view('admin.home', $data);
    }
}