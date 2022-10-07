@extends('layouts.dashboard')

@section('content')
    <div class="container">
        @foreach ($orders as $singleOrder)
            @if ($singleOrder->confirmed)
                <h2>{{ $singleOrder }}</h2>
                @foreach ($dishOrder as $singleDishOrder)
                    @foreach ($singleDishOrder as $item)
                        @if ($singleOrder->id == $item->order_id )
                            {{$item}}
                        @endif
                    @endforeach
                @endforeach
                <a href="{{ route('admin.stats.show', ['stat' => $singleOrder->id]) }}"
                    class="btn ms_btn">
                    Dettagli ordine
                </a>
            @endif
        @endforeach
    </div>
@endsection