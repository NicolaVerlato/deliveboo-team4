@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h2 class="ms_title">Ordini effettuati nel tuo ristorante</h2>
        @foreach ($orders as $singleOrder)
            <div>
                @if ($singleOrder->confirmed)
                    <h3>Nome utente: {{ $singleOrder->customer_name }}</h3>
                    <h3>Email: {{ $singleOrder->customer_email }}</h3>
                    <h3>Indirizzo: {{ $singleOrder->customer_address }}</h3>
                    <p>Ordine generato il: {{$singleOrder->created_at}}</p>
                    <p>Ordine pagato il: {{$singleOrder->updated_at}}</p>
                    @foreach ($dishOrder as $singleDishOrder)
                        {{-- @foreach ($singleDishOrder as $item)
                            @if ($singleOrder->id == $item->order_id )

                            @endif
                        @endforeach --}}
                    @endforeach
                    <a href="{{ route('admin.stats.show', ['stat' => $singleOrder->id]) }}"
                        class="btn ms_btn">
                        Dettagli ordine
                    </a>
                @endif
            </div>
        @endforeach
    </div>
@endsection