@extends('layouts.dashboard')

@section('content')

    <h2 class="ms_title">Il mio ristorante</h2>
    <div class="card card_ms" style="width: 18rem;">
        @if ($restaurant['cover'])
            <img class="card-img-top" src="{{ asset('storage/' . $restaurant->cover) }}" alt="{{$restaurant['title']}}">
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
            <form action="{{ route('admin.restaurants.destroy', ['restaurant' => $restaurant->id]) }}" method="POST">
                @csrf
                @method('DELETE')
        
                <input type="submit" value="Cancella Post" class="btn btn-danger mt-2">
            </form>
            {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
        </div>
    </div>
@endsection