@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div>
            <h1 class="mt-3">Non puoi creare più di un ristorante!</h1>
            <h4 class="mt-3">
                Per tornare alla dashboard
                <a href="{{ route('admin.home') }}">clicca qui</a> o il pulstante qui sotto.
                <a href="{{ route('admin.home') }}">
                    <div class="circle"></div>
                </a>
            </h4>
        </div>
    </div>
@endsection