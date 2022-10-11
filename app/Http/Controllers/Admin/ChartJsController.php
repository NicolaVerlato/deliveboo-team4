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
            $month = ['1','2','3','4','5','6', '7', '8', '9', '10', '11', '12'];
            $monthName = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
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
                foreach ($allOrdersDate as $secondKey => $secondValue) {
                    if ($secondValue == $value) {
                        $orders[$value - 1] += $allOrders[$key]->order_total;
                    }
                }
            }
            // cambio nome al mese
            foreach ($month as $key => $value) {
                $month = array_combine(array_map('ucfirst', array_keys($month)), $monthName);
            }
            $total = 0;
            foreach ($orders as $key => $value) {
                $total += $value;
            }
    
            $data = [
                'restaurantLink' => $restaurantLink,
                'totalOrders' => $total
            ];
            return view('admin.chartjs.index', $data)->with('month',json_encode($month,JSON_NUMERIC_CHECK))->with('order',json_encode($orders,JSON_NUMERIC_CHECK));
    
        }
        public function show($id) {
            $user = Auth::user();
            $now = Carbon::now()->month;
            $data = [];
            $allOrdersDate = [];
            $month = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
            $restaurantLink = Restaurant::where('user_id', '=', $user->id)->get();
            $orders = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0, 13 => 0, 14 => 0, 15 => 0, 16 => 0, 17 => 0, 18 => 0, 19 => 0, 20 => 0, 21 => 0, 22 => 0, 23 => 0, 24 => 0, 25 => 0, 26 => 0, 27 => 0, 28 => 0, 29 => 0, 30 => 0, 31 => 0);
            $allOrders = Order::where('restaurant_id', '=', $restaurantLink[0]->id)->get();
            $filteredMonthOrder = [];
            foreach ($allOrders as $OrderKey => $OrderValue) {
                $singleOrder = Carbon::createFromFormat('Y-m-d H:i:s', $OrderValue->created_at)->format('m');
                if($singleOrder >= $now) {
                    $singleOrder = Carbon::createFromFormat('Y-m-d H:i:s', $OrderValue->created_at)->format('d');
                    array_push($allOrdersDate, $singleOrder);
                }
            }

            $quantity = $orders;
            foreach ($month as $dayKey => $singleDay) {
                foreach ($allOrdersDate as $secondKey => $secondValue) {
                    if ($secondValue == $singleDay) {
                        $orders[$dayKey + 1] += $allOrders[$secondKey]->order_total;
                        $quantity[$dayKey + 1] += 1;
                    }
                }
            }
            $orders = array_values($orders);
            $quantity = array_values($quantity);
            $total = 0;
            foreach ($orders as $key => $value) {
                $total += $value;
            }
            $data = [
                'restaurantLink' => $restaurantLink,
                'totalOrders' => $total
            ];
            return view('admin.chartjs.month', $data)->with('month',json_encode($month,JSON_NUMERIC_CHECK))->with('order',json_encode($orders,JSON_NUMERIC_CHECK))->with('quantity',json_encode($quantity,JSON_NUMERIC_CHECK));
        }
    
}
