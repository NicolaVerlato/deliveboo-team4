@extends('layouts.dashboard')

@section('content')
    <h1>I tuoi piatti</h1>

    @foreach ($dishes as $dish)

        {{-- inizio card dish --}}
        <div class="card">
            {{-- <img src="..." class="card-img-top" alt="..."> --}}
            <div class="card-body">
            <h5 class="card-title">{{ $dish->name }}</h5>
            <p class="card-text">{{ $dish->description }}</p>
            <a href="{{ route('admin.dishes.show', ['dish' => $dish->id]) }}" class="btn btn-primary">Dettagli</a>
            </div>
        </div>
        {{-- fine card dish --}}
        
    @endforeach
@endsection
    
