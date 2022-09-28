@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1 class="mb-3">{{ $dishes->name }}</h1>

        @if ($dishes->cover)
            <img class="w-30" src="{{ asset('storage/' . $dishes->cover) }}" alt="{{ $dishes->title }}">
        @endif

        <p class="mt-3">{{ $dishes->description }}</p>

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

        <a href="{{ route('admin.dishes.edit', ['dish' => $dishes->id]) }}" class="btn btn-primary mb-2 mt-2">Modifica</a>
        <form action="{{ route('admin.dishes.destroy', ['dish' => $dishes->id]) }}" method="post">
            @csrf
            @method('DELETE')

            <input type="submit" class="btn btn-danger" value="Elimina" onClick="">
        </form>
    </div>
@endsection
    