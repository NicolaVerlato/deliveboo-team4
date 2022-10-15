@extends('layouts.dashboard')

@section('content')
    <div class="container" style="display: contents">
        <h2 class="ms_title">Il mio ristorante</h2>
        <div class="card card_ms brand_color" style="width: 18rem;">
            @if ($restaurant['cover'])
                <img class="restaurant-card-img" src="{{ asset('storage/' . $restaurant->cover) }}" alt="{{$restaurant['title']}}">
            @else
                <img class="restaurant-card-img" src="{{ asset('images/default-image.jpeg') }}" alt="Default image">
            @endif
            <div class="card-body">
                <h1 class="card-title">{{$restaurant->name}}</h1>
                <p class="card-text">Indirizzo: {{$restaurant['address']}}</p>
                <p>{{ $restaurant->created_at->diffForHumans($now) }}</p>
                <p>
                    @if (count($restaurant->types->toArray()))
                        <strong>Tags:</strong>
                        @foreach ($restaurant->types as $tag)
                            {{ $tag->name }}{{ !$loop->last ? ',' : '' }}
                        @endforeach
                    @else
                    Nessun tag
                    @endif
                </p>
                <p >Creato il: {{ $restaurant->created_at->format('j/m/Y') }} alle {{ $restaurant->created_at->format('G:i:s') }}</p>
                {{-- delete da aggiungere se vogliamo --}}
                {{-- <form action="{{ route('admin.restaurants.destroy', ['restaurant' => $restaurant->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
            
                    <input type="submit" value="Cancella Ristorante" class="btn btn-danger mt-2">
                </form> --}}
            </div>
        </div>
    </div>
    
@endsection