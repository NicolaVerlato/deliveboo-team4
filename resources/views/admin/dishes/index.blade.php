<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>I tuoi piatti</h1>

    @foreach ($dishes as $dish)

        {{-- inizio card dish --}}
        <div class="card">
            {{-- <img src="..." class="card-img-top" alt="..."> --}}
            <div class="card-body">
            <h5 class="card-title">{{ $dish->name }}</h5>
            <p class="card-text">{{ $dish->description }}</p>
            <a href="{{ route('admin.dishes.show', ['dish' => $dish->id]) }}" class="btn btn-primary">Dettagli</a>
            </div>
        </div>
        {{-- fine card dish --}}
        
    @endforeach
</body>
</html>