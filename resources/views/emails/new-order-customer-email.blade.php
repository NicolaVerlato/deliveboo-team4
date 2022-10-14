<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Ciao {{$order->customer_name}}, il tuo ordine è stato effettuato con successo.</h1>

    <p>Presto riceverai il tuo ordine all'indirizzo:</p>
    <h5>{{$order->customer_address}}</h5>
    
    @foreach ($orderRecap as $item)
        @if ($order->id === $item->order_id)
            @foreach ($allRestaurantDishes as $singleDish)
                @if ($item->dish_id === $singleDish->id)
                    Piatto:{{$singleDish->name}}<br>Prezzo unitario: {{$singleDish->price}}<br> Quantità: {{$item->quantity}}<br><br>
                @endif
            @endforeach
        
            
        @endif
    @endforeach

    <h2>Prezzo totale: {{$order->order_total}}</h2>

    <p>Buon appetito! <br>
        Team di Deliveboo
    </p>
</body>
</html>