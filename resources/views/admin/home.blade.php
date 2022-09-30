@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header brand_color">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>
                        Ciao {{$user->name}}

                        @if ($user->lastname)
                            {{$user->lastname}}
                        @endif
                    </h2>
                    
                    <h4>Mail: {{ $user->email }}</h4>
                    <p>La tua partita iva è: {{ $user->iva }}</p>
                    <p>Created {{ $user->created_at->diffForHumans($now) }}</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
