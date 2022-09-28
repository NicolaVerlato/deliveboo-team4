@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1 class="mb-3">I tuoi piatti</h1>

        <div class="row row-cols-3">
            @if (!$dishes->isEmpty())
                @foreach ($dishes as $dish)
                    <div class="col">
                        {{-- inizio card dish --}}
                        <div class="card mb-4">
                            @if ($dish->cover)
                                <img src="{{ asset('storage/' . $dish->cover) }}" class="card-img-top" alt="{{ $dish->name }}">
                            @endif
                            
                            <div class="card-body">
                            <h5 class="card-title">{{ $dish->name }}</h5>
                            <p class="card-text">{{ $dish->description }}</p>
                
                            <a href="{{ route('admin.dishes.show', ['dish' => $dish->id]) }}" class="btn btn-primary">Dettagli</a>
                            <a href="{{ route('admin.dishes.edit', ['dish' => $dish->id]) }}" class="btn btn-primary">Modifica</a>
                            </div>
                        </div>
                        {{-- fine card dish --}}
                    </div>
                @endforeach
                    
                <div class="mt-2">
                    {{ $dishes->links() }}
                </div>
            @else
                <div>
                    <h3>Non hai ancora nessun piatto.</h3>
                    <a href="{{ route('admin.dishes.create') }}" class="mt-2 btn btn-primary">Clicca qui per aggiugerne uno!</a>  
                </div>
            @endif
        </div>
    </div>
@endsection
    
