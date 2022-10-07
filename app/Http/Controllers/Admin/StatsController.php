<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\Order;
use App\DishOrder;
use App\Dish;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $dishOrderArray = [];
        $restaurant = Restaurant::where('user_id', '=', $user->id)->first();
        $orders = Order::where('restaurant_id', '=', $restaurant->id)->get();
        foreach ($orders as $key => $value) {
            $dish_order = DishOrder::where('order_id', '=', $value->id)->get();
            if(count($dish_order) > 0) {
                $dishOrderArray[] = $dish_order;
            }
        }
        $restaurantLink = Restaurant::where('user_id', '=', $user->id)->get();
        $data = [
            'orders' => $orders,
            'restaurantLink' => $restaurantLink,
            'dishOrder' => $dishOrderArray
        ];
        return view('admin.stats.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $restaurantLink = Restaurant::where('user_id', '=', $user->id)->get();
        $order = Order::findOrFail($id);
        $dish_order = DishOrder::where('order_id', '=', $order->id)->get();
        
        $allDishes = [];
        foreach ($dish_order as $key => $SingleDishOrder) {
            $dish = Dish::findOrFail($SingleDishOrder->dish_id);
            $allDishes[] = $dish;
        }

        $data = [
            'restaurantLink' => $restaurantLink,
            'order' => $order,
            'dish_order' => $dish_order,
            'allDishes' => $allDishes
        ];
        return view('admin.stats.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
