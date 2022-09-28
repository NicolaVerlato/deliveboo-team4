@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <h1>Crea post</h1>
                <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                    <label for="name">Nome ristorante</label>
                    <input type="text" class="form-control" id="name" placeholder="Nome" name="name" value="{{ old('name') }}">
                    </div>

                    <div class="mt-5 mb-5">
                    <h3>Tipo ristorante</h3>
                    @foreach ($types as $type)
                        <div class="form-check">
                        <input class="form-check-input" 
                        type="checkbox" 
                        value="{{ $type->id }}" 
                        id="type-{{ $type->id }}" 
                        name="types[]"
                        {{ in_array($type->id, old('type', [])) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="type-{{ $type->id }}">
                            {{$type->name}}
                        </label>
                        </div>
                    @endforeach
                    </div>

                    <div class="mb-3">
                        <label for="address">Indirizzo Ristorante</label>
                        <input type="text" class="form-control" id="address" placeholder="Indirizzo" name="address" value="{{ old('address') }}">
                    </div>

                    <div class="mb-3">
                        <label for="cover" class="form-label">Immagine</label>
                        <input class="ms_form" type="file" id="cover" name="cover">
                    </div>

                    <button type="submit" class="btn d-block mt-5 btn-primary">Submit</button>
                </form>

        </div>
    </div>
</div>
@endsection
