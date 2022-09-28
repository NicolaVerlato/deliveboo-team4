@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="card p-3">
            <h1 class="card-title">{{ $dishes->name }}</h1>

            @if ($dishes->cover)
                <img class="card-img-top" src="{{ asset('storage/' . $dishes->cover) }}" alt="{{ $dishes->title }}">
            @endif

            <p class="card-text">{{ $dishes->description }}</p>

            <div>
                Prezzo: {{ $dishes->price }} &euro;
            </div>

            <div>
                Visibile nel sito: 
                @if ($dishes->is_visible)
                    si
                @else
                    no
                @endif
            </div>

            <div>
                <a href="{{ route('admin.dishes.edit', ['dish' => $dishes->id]) }}" class="btn btn-primary mb-2 mt-2">Modifica</a>
            </div>

            <form action="{{ route('admin.dishes.destroy', ['dish' => $dishes->id]) }}" method="post">
                @csrf
                @method('DELETE')

                <input type="submit" class="btn btn-danger" value="Elimina" onClick="">
            </form>
        </div>
    </div>
@endsection
    