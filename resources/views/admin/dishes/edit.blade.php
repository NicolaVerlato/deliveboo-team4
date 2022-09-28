@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1 class="mb-3">Modifica il tuo piatto</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.dishes.update', ['dish' => $dish->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label"><span>*</span> Nome del piatto:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $dish->name) }}">
            </div>

            <div class="mb-3">
                <label for="cover" class="form-label">Immagine:</label>
                <input type="file" id="cover" name="cover" value="{{ old('cover', $dish->cover) }}">
                @if ($dish->cover)
                    <div>
                        <div>
                            Immagine presente:
                        </div>
                        <img class="mt-3 w-30" src="{{ asset('storage/' . $dish->cover) }}" alt="{{ $dish->title }}">
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><span>*</span> Descrizione piatto:</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{ old('description', $dish->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label"><span>*</span> Prezzo:</label>
                <input type="number" step=".01" class="form-control" id="price" name="price" value="{{ old('price', $dish->price) }}">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" value="1" id="is_visible" name="is_visible" 
                {{ (old('is_visible', $dish->is_visible) == 1) ? 'checked' : '' }}>

                <label class="form-check-label" for="is_visible">Presente nel menu</label>
            </div>

            <div class="mb-2">
                <i>Tutti i campi contrassegnati con <span>*</span> sono obbligatori</i>
            </div>

            <input type="submit" class="btn ms_btn" value="Salva">
        </form>
    </div>

@endsection
    