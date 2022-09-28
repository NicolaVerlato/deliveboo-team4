@extends('layouts.dashboard')

@section('content')
    <h1>Modifica il tuo piatto</h1>

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
            <label for="name" class="form-label">Nome del piatto:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $dish->name) }}">
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">Immagine:</label>
            <input type="file" id="cover" name="cover" value="{{ old('cover', $dish->cover) }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione piatto:</label>
            <textarea name="description" id="description" cols="30" rows="10">{{ old('description', $dish->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo:</label>
            <input type="number" step=".01" class="form-control" id="price" name="price" value="{{ old('price', $dish->price) }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_visible" name="is_visible" value="1"
            {{ (old('is_visible', $dish->is_visible) == 1) ? 'checked' : '' }}>

            <label class="form-check-label" for="is_visible">Presente nel menu</label>
        </div>

        <input type="submit" class="btn btn-primary" value="Salva">
    </form>

@endsection
    