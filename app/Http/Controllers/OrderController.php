<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

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
    public function create($price)
    {
        $data = [
            'TotalPrice' => $price
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
        // qua manca da aggiungere la FK del ristorante
        $newOrder->save();

        return redirect()->route('orders.edit', ['order' => $newOrder->id]);
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

        // PASSAGGIO DEL TOKEN ALLA ROTTA
        $token = $gateway->ClientToken()->generate();
        return view('orders.edit', ['token' => $token, 'order' => $order]);
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
            // !!!!!!! QUI METTEREMO I PIATTI PASSATI DALLA CREATE ALLO STORE ALLA EDIT E INFINE ALL'UPDATE
            $data = [
                'prezzo' => $order->order_total,
                
            ];
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
