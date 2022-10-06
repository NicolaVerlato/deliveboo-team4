@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">

                <div class="card-header"> {{'Registrazione'}} </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Name section  --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><span>*</span> {{'Nome'}} </label>

                            <div class="col-md-6">
                                <input 
                                    id="name" 
                                    type="text" 
                                    class="form-control 
                                    @error('name') is-invalid @enderror" 
                                    name="name" value="{{ old('name') }}" 
                                    required autocomplete="name" 
                                    autofocus
                                >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Lastname section  --}}
                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right"> {{'Cognome'}} </label>

                            <div class="col-md-6">
                                <input 
                                    id="lastname" 
                                    type="text" 
                                    class="form-control"
                                    name="lastname" 
                                    value="{{ old('lastname') }}" 
                                    autocomplete="Cognome" 
                                    autofocus
                                >
                            </div>
                        </div>

                        {{-- Email section  --}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><span>*</span> {{'Indirizzo email'}} </label>

                            <div class="col-md-6">
                                <input 
                                    id="email" 
                                    type="email" 
                                    class="form-control 
                                    @error('email') is-invalid @enderror" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required autocomplete="email"
                                >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Password section  --}}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><span>*</span> {{'Password'}} </label>

                            <div class="col-md-6">
                                <input 
                                    id="password" 
                                    type="password" 
                                    class="form-control 
                                    @error('password') is-invalid @enderror" 
                                    name="password" 
                                    required autocomplete="new-password"
                                >
                                <div id="password-message"></div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Confirm password section  --}}                        
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><span>*</span> {{'Conferma Password'}} </label>

                            <div class="col-md-6">
                                <input 
                                    id="password-confirm" 
                                    type="password" 
                                    class="form-control" 
                                    name="password_confirmation" 
                                    required autocomplete="new-password"               
                                >
                            </div> 
                        </div>

                        {{-- messaggio di password errata --}}
                        <div id="user-message" style="text-align:center;margin-bottom:10px;color:red"></div>

                        {{-- Partita iva section  --}}
                        <div class="form-group row">
                            <label for="iva" class="col-md-4 col-form-label text-md-right"><span>*</span> {{'Partita IVA'}} </label>

                            <div class="col-md-6">
                                <input 
                                    id="iva" 
                                    type="text"
                                    pattern="[0-9]+"
                                    placeholder="composta da 11 numeri" 
                                    class="form-control 
                                    @error('iva') is-invalid @enderror" 
                                    name="iva" 
                                    required
                                    value="{{ old('iva') }}"
                                >

                                <div id="iva-message"></div>

                                @error('iva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <i>Tutti i campi contrassegnati con <span>*</span> sono obbligatori</i>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="btn">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
