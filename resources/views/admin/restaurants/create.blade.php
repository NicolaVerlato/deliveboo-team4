@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <h1>Crea il tuo ristorante</h1>
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
                    <label for="name"><span>*</span> Nome ristorante</label>
                    <input type="text" class="form-control" id="name" placeholder="Nome" name="name" required value="{{ old('name') }}">
                    </div>

                    <div class="mt-5 mb-5">
                        <div class="mb-2">
                            <span><span>*</span> Tipo ristorante</span>
                            <span><i>( selezionare almeno una categoria )</i></span>
                        </div>
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
                        <div id="user-message" class="mt-2"></div>
                    </div> 

                    <div class="mb-3">
                        <label for="address"><span>*</span> Indirizzo Ristorante</label>
                        <input type="text" required class="form-control" id="address" placeholder="Indirizzo" name="address" value="{{ old('address') }}">
                    </div>

                    <div class="mb-3">
                        <label for="cover" class="form-label">Immagine</label>
                        <input class="ms_form" type="file" id="cover" name="cover">
                    </div>

                    <div class="mb-2">
                        <i>Tutti i campi contrassegnati con <span>*</span> sono obbligatori</i>
                    </div>

                    <button id="btn-create" type="submit" class="btn d-block mt-2 btn-primary">Invia</button>
                </form>

        </div>
    </div>
</div>
@endsection
