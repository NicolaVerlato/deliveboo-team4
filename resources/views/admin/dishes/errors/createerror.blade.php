@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div>
            <h1 class="mt-3">Non puoi creare un piatto prima di aver creato un ristorante</h1>
            <h4 class="mt-3">
                Per creare un ristorante 
                <a href="{{ route('admin.restaurants.create') }}">clicca qui</a> o il pulstante qui sotto.
                <a href="{{ route('admin.restaurants.create') }}">
                    <div class="circle"></div>
                </a>
            </h4>
        </div>
    </div>
@endsection