<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Dish;
use App\DishOrder;
use App\Restaurant;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class ChartJsController extends Controller
{
    
        public function index() {
            $period = now()->subMonths(12)->monthsUntil(now());
            $month = ['0','1','2','3','4','5','6', '7', '8', '9', '10', '11', '12'];
            $user = Auth::user();
            $data = [];
            $orders = [];
            $ordersTable = [];
            $allOrdersDate = [];
            $orders = array(0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0);
            $restaurantLink = Restaurant::where('user_id', '=', $user->id)->get();
            $allOrders = Order::where('restaurant_id', '=', $restaurantLink[0]->id)->get();
            foreach ($allOrders as $OrderKey => $OrderValue) {
                $singleOrder = Carbon::createFromFormat('Y-m-d H:i:s', $OrderValue->created_at)->format('m');
                array_push($allOrdersDate, $singleOrder);
            }
            foreach ($month as $key => $value) {
                // dd($restaurantLink[0]->id);
               
                
                // $orders[] = $singleOrder;
                // foreach ($orders as $key => $orderValue) {
                //     if($orderValue == $value) {
                //         $ordersTable[] = 1;
                //     }
                // }
                // dd($allOrdersDate);
                foreach ($allOrdersDate as $secondKey => $secondValue) {
                    if ($secondValue == $value) {
    
                        $orders[$value] += 1;
                    }
                }
            }
            $total = 0;
            foreach ($orders as $key => $value) {
                $total += $value;
            }
    
    
            $data = [
                'restaurantLink' => $restaurantLink,
                'totalOrders' => $total
            ];
            // dd($ordersTable);
            // dd($orders);
            return view('admin.chartjs.index', $data)->with('month',json_encode($month,JSON_NUMERIC_CHECK))->with('order',json_encode($orders,JSON_NUMERIC_CHECK));
    
        }
    
}
