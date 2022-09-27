<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <h1>{{ $dishes->name }}</h1>

        @if ($dishes->cover)
            <img class="w-50" src="{{ asset('storage/' . $dishes->cover) }}" alt="{{ $dishes->title }}">
        @endif

        <p>{{ $dishes->description }}</p>

        <div>
            {{ $dishes->price }} &euro;
        </div>

        <div>
            {{ $dishes->is_visible }}
        </div>
    </div>
</body>
</html>