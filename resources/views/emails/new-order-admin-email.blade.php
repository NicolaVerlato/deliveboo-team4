<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Ciao {{$restaurantOwner->name}}, è stato effettuato un nuovo ordine dal tuo ristorante.</h1>
    
    @foreach ($orderRecap as $item)
        @if ($order->id === $item->order_id)
            @foreach ($allRestaurantDishes as $singleDish)
                @if ($item->dish_id === $singleDish->id)
                    Piatto:{{$singleDish->name}}<br> Quantità: {{$item->quantity}}<br><br>
                @endif
            @endforeach
        
            
        @endif
    @endforeach

    <h2>Prezzo totale: {{$order->order_total}}</h2>

    <p>Saluti, <br>
        Team di Deliveboo
    </p>
</body>
</html>