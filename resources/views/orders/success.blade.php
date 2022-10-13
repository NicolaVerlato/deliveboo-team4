<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Pagamento effettuato</title>
</head>

<body style="background-color: #fea543; color: white; font-family: 'Nunito', sans-serif;">

    <h2 style="margin-bottom: 45px; font-size: 35px; text-align: center;">
        <strong>Deliveb<i class="fa-solid fa-cookie-bite"></i><i class="fa-solid fa-cookie-bite"></i></strong>
    </h2>

    <h4 style="text-align: center;">Grazie {{$nome}}, pagamento effettuato con successo</h4>

    <h4 style="text-align: center;">Ordine spedito a "{{$indirizzo}}" dal ristorante {{$ristorante->name}}</h4>

    <h4 style="text-align: center;">Riepilogo ordine</h4>
    <ul style="text-align: center;">
        @foreach ($dish_order as $singleDishOrder)
            @if ($order->id === $singleDishOrder->order_id)
                @foreach ($allRestaurantDishes as $singleDish)                  
                    @if ($singleDishOrder->dish_id === $singleDish->id)
                        
                    <li style="text-align: center;">Nome piatto: {{$singleDish->name}}, quantità: {{$singleDishOrder->quantity}}</li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>
    <h3 style="text-align: center;">Prezzo {{$prezzo}}&euro;</h3>

    <div style="text-align: center;">
        <a style="color: white; text-decoration: none;" href="http://127.0.0.1:8000/"> Torna alla home </a>
    </div>
</body>

</html>