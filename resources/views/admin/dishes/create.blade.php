@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1 class="mb-3">Crea il tuo piatto</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.dishes.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label"><span>*</span> Nome del piatto:</label>
                <input type="text" required class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="cover" class="form-label">Immagine:</label>
                <input type="file" id="cover" name="cover" value="{{ old('cover') }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><span>*</span> Descrizione piatto:</label>
                <textarea name="description" required class="form-control" id="description" cols="30" rows="5">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label"><span>*</span> Prezzo:</label>
                <input type="number" step=".01" required class="form-control" id="price" name="price" value="{{ old('price') }}">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_visible" name="is_visible" value="1">

                <label class="form-check-label" for="is_visible">Presente nel menu</label>
            </div>

            <div class="mb-2">
                <i>Tutti i campi contrassegnati con <span>*</span> sono obbligatori</i>
            </div>

            <input type="submit" class="btn ms_btn" value="Salva">
        </form>
    </div>
@endsection
