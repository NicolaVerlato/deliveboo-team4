@extends('layouts.dashboard')

@section('content')
    <div class="container">
        {{-- stampo ordine--}}
        <h3>Nome utente: {{$order->customer_name}}</h3>
        <h3>Email: {{$order->customer_email}}</h3>
        <h3>Indirizzo: {{$order->customer_address}}</h3>

        <div class="mt-3">
            {{-- per ogni dish_order stampo --}}
            @foreach ($dish_order as $singleDishOrder)
            @foreach ($allDishes as $singleDish)
            {{-- se il singolo piatto corrisponde al singolo elemento della tabella ponte --}}
                @if ($singleDish->id == $singleDishOrder->dish_id)
                    <h4>Piatto: {{$singleDish->name}}</h4>
                @endif
            @endforeach
            @endforeach
            <h4>Prezzo totale: {{ $order->order_total}}&euro;</h4>
        </div>

    </div>
@endsection