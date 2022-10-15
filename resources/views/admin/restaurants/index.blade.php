@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="container" style="display: contents">
        <h2 class="text-center">Il mio ristorante</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($restaurants as $restaurant)
                    <div>
                        <div class="card mt-3">
                            <div class="card-header ms_card_header">
                            Ristorante
                            </div>
                            <div class="card-body">
                                <h2 class="title_list mt-3">{{ $restaurant->name }}</h2>
                                <p class="card-text">Indirizzo: {{  $restaurant->address }}</p>
                                <p>Slug: {{ $restaurant->slug }}</p>
                                <p>{{ $restaurant->created_at->diffForHumans($now) }}</p>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->id]) }}"
                                        class="btn ms_btn">
                                        Dettagli ristorante
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
