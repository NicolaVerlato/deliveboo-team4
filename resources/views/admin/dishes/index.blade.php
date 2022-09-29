@extends('layouts.dashboard')

@section('content')
    <div class="container">
        @if ($deleted === 'yes')
            <div class="alert alert-success" role="alert">
                Piatto eliminato con successo
            </div>
        @endif

        <h1 class="mb-3">I tuoi piatti</h1>

        <div class="row row-cols-3">
            @if (!$dishes->isEmpty())
                @foreach ($dishes as $dish)
                    <div class="col">
                        {{-- inizio card dish --}}
                        <div class="card border_radius20 card_hei mb-4">
                            @if ($dish->cover)
                                <img src="{{ asset('storage/' . $dish->cover) }}" class="card-img-top" alt="{{ $dish->name }}">
                            @else
                                <img src="{{ asset('images/default-image.jpeg') }}" alt="Default image">
                            @endif
                            
                            <div class="card-body">
                            <h5 class="card-title">{{ $dish->name }}</h5>
                            <p class="card-text ms_description flex-grow-1">{{ $dish->description }}</p>
                
                            <div class="ms_button_card align-items-end d-flex">
                                <div>
                                    <a href="{{ route('admin.dishes.show', ['dish' => $dish->id]) }}" class="btn ms-btn">Dettagli</a>
                                    <a href="{{ route('admin.dishes.edit', ['dish' => $dish->id]) }}" class="btn ms-btn">Modifica</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        {{-- fine card dish --}}
                    </div>
                @endforeach
                
            @else
                <div>
                    <h3>Non hai ancora nessun piatto.</h3>
                    <a href="{{ route('admin.dishes.create') }}" class="mt-2 btn ms-btn">Clicca qui per aggiugerne uno!</a>  
                </div>
            @endif
        </div>
        <div class="mt-2 pagination">
            {{ $dishes->links() }}
        </div>
    </div>
@endsection
    
