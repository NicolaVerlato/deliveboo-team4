@extends('layouts.dashboard')

@section('content')
    <div>
        <h1>{{ $dishes->name }}</h1>

        @if ($dishes->cover)
            <img class="w-50" src="{{ asset('storage/' . $dishes->cover) }}" alt="{{ $dishes->title }}">
        @endif

        <p>{{ $dishes->description }}</p>

        <div>
            {{ $dishes->price }} &euro;
        </div>

        <div>
            Visibile nel sito: 
            @if ($dishes->is_visible)
                si
            @else
                no
            @endif
        </div>

        <a href="{{ route('admin.dishes.edit', ['dish' => $dishes->id]) }}" class="btn btn-primary mb-3 mt-2">Modifica</a>
        <form action="{{ route('admin.dishes.destroy', ['dish' => $dishes->id]) }}" method="post">
            @csrf
            @method('DELETE')

            <input type="submit" class="btn btn-danger" value="Elimina" onClick="">
        </form>
    </div>
@endsection
    