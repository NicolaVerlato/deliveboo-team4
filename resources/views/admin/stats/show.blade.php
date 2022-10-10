@extends('layouts.dashboard')

@section('content')
    <div class="container text-center">
        {{-- stampo ordine--}}
        <h1>Nome utente: {{$order->customer_name}}</h1>
        <h3>Email: {{$order->customer_email}}</h3>
        <h3>Indirizzo: {{$order->customer_address}}</h3>

        <div class="row row-cols-4 mt-3">
            {{-- per ogni dish_order stampo --}}
            @foreach ($dish_order as $singleDishOrder)
            @foreach ($allDishes as $singleDish)
            {{-- se il singolo piatto corrisponde al singolo elemento della tabella ponte --}}
                @if ($singleDish->id == $singleDishOrder->dish_id)
                    <div class="col">
                        <div class="little_card" style="width: 15rem;">
                            <h4 class="mt-4"><strong>Piatto:</strong> {{$singleDish->name}}</h4>
                            <h4><strong>Quantità:</strong> {{$singleDishOrder->quantity}}</h4>
                        </div>
                    </div>
                @endif
            @endforeach
            @endforeach
            <h4 class="mt-4">Prezzo totale: {{ $order->order_total}}&euro;</h4>
        </div>
    </div>
@endsection