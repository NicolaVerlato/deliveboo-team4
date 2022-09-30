@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="card card_ms" style="width: 20rem;">
                        
            @if ($dishes->cover)
                <img class="card-img-top img_ms" src="{{ asset('storage/' . $dishes->cover) }}" alt="{{ $dishes->title }}">
            @else
                <img class="card-img-top" src="{{ asset('images/default-image.jpeg') }}" alt="Default image">
            @endif
            
            <div class="p-3">
                <h1 class="card-title">{{ $dishes->name }}</h1>

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
                    <a href="{{ route('admin.dishes.edit', ['dish' => $dishes->id]) }}" class="btn ms_btn_dark mb-2 mt-2">Modifica</a>
                </div>
                
                <form action="{{ route('admin.dishes.destroy', ['dish' => $dishes->id]) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <input type="submit" class="btn btn-danger" value="Elimina" onClick="return confirm('Confermi di voler cancellare il piatto')">
                </form>
            </div>
        </div>
    </div>
@endsection
    