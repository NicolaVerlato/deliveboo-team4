<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Dish;
use App\DishOrder;
use App\Restaurant;
use App\User;
use Illuminate\Support\Str;
use App\Mail\SendNewMail;
use App\Mail\SendCustomerNewMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($price, $id, $allDishesIds, $quantity, Dish $dish)
    {
        $allDish = collect();
        $allQuantity = collect();
        for ($i=0; $i < Str::length($allDishesIds); $i++) { 
            if($allDishesIds[$i] == '-') {

            } else if (!is_nan($allDishesIds[$i])) {
                $allDish->push($allDishesIds[$i]);
            }
        }
        preg_match_all('!\d+!', $allDishesIds, $matches);

        for ($i=0; $i < Str::length($quantity); $i++) { 
            if($quantity[$i] == '-') {
    
            } else {
                $allQuantity->push($quantity[$i]);
            }
        }
        $dish_id = Dish::where('id', '=', $id)->get();

        $price = $price / 2353699835353;
        $price = $price * 100;
        $price = $price / 23425232;

        if ($price < 1) {
            return view('orders.error');
        }
        $data = [
            'TotalPrice' => $price,
            'restaurant_id' => $dish_id[0]->restaurant_id,
            'dish_id' => $matches,
            'quantity' => $allQuantity
        ];
        return view('orders.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order_data = $request->all();
        
        $newOrder = new Order();
        $newOrder->fill($order_data);
        $newOrder->confirmed = 0;
        $newOrder->save();
        $dishes = collect();
        $amount = collect();
        $string = 'dish_id-';
        function startsWith( $order_data, $stringa ) {
            $length = strlen( $stringa );
            return substr($order_data, 0, $length ) === $stringa;
       }
       $ids = [];
       foreach ($order_data as $key => $value) {
            if (startsWith($key, $string)) {
                $ids[] = $value;                
            }
        }

        foreach ($ids as $char) {
            if (is_numeric($char)) {
                $searchDish = Dish::where('id', '=', $char)->get();
                if (count($searchDish) > 0) {
                    $dishes->push( Dish::where('id', '=', $char)->get());
                }
            }
        }
        $cycle = 0;

        $secondString = 'quantity-';
        foreach ($order_data as $key => $value) {
            $cycle ++;
            if (startsWith($key, $secondString)) {
                $amount[] = $value;                
            }
        }
        $cycle = 0;

        foreach ($dishes as $key => $value) {
            $cycle ++;
            $newDishOrder = new DishOrder();
            // $newDishOrder->fill($value[0]);
            $newDishOrder->dish_id = $value[0]['id'];
            $newDishOrder->order_id = $newOrder['id'];
            $newDishOrder->quantity = $amount[$cycle - 1];
            $newDishOrder->save();
        }

        

        return redirect()->route('orders.edit', ['order' => $newOrder->id])->with( ['data' => $order_data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        // INIZIALIZZAZIONE BRAINTREE
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => '6k6m4rt6hmfwpqcf',
            'publicKey' => '68td22tzfk475g8b',
            'privateKey' => '3ebce2639ade8dd638023434949ad1c1'
        ]);

        $data = [
            'order' => $order,
        ];

        // PASSAGGIO DEL TOKEN ALLA ROTTA
        $token = $gateway->ClientToken()->generate();
        return view('orders.edit', ['token' => $token, 'order' => $order], $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // INIZIALIZZAZIONE BRAINTREE
        $gateway = new \Braintree\Gateway([
            'environment' => 'sandbox',
            'merchantId' => '6k6m4rt6hmfwpqcf',
            'publicKey' => '68td22tzfk475g8b',
            'privateKey' => '3ebce2639ade8dd638023434949ad1c1'
        ]);

        //NONCE DAL CLIENTE
        $nonceFromTheClient = $request->payment_method_nonce;

        //RISULTATO DEL PAGAMENTO
        $result = $gateway->transaction()->sale([
            'amount' => $order->order_total,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);
        if ($result->success) {
            $ristorante = Restaurant::find($order->restaurant_id);
            $dish_order = DishOrder::where('order_id', '=', $order->id)->get();
            $allRestaurantDishes = Dish::where('restaurant_id', '=', $ristorante->id)->get();
            $order->confirmed = 1;
            $order->save();

            $data = [
                'prezzo' => $order->order_total,
                'nome' => $order->customer_name,
                'mail' => $order->customer_email,
                'indirizzo' => $order->customer_address,
                'ristorante' => $ristorante,
                'order' => $order,
                'allRestaurantDishes' => $allRestaurantDishes,
                'dish_order' => $dish_order
            ];
            // Invio email al ristoratore per il nuovo ordine
            $restaurantOwner = User::findOrFail($ristorante->user_id);
            Mail::to($restaurantOwner->email)->send(new SendNewMail($order));
            
            // Invio email all'acquirente per il nuovo ordine
            Mail::to($order->customer_email)->send(new SendCustomerNewMail($order));

            return view('orders.success', $data);
        } else {
            return view('orders.failed');
        }
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
