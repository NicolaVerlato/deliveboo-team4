@extends('layouts.dashboard')

@section('content')
    <div class="container">
        {{-- stampo ordine normale --}}
        {{$order}}

        {{-- per ogni dish_order stampo --}}
        @foreach ($dish_order as $singleDishOrder)
            @foreach ($allDishes as $singleDish)
            {{-- se il singolo piatto corrisponde al singolo elemento della tabella ponte --}}
                @if ($singleDish->id == $singleDishOrder->dish_id)
                    {{$singleDish->name}}
                @endif
            @endforeach
        @endforeach

    </div>
@endsection