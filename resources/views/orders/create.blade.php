<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Dati consegna</title>
</head>

<body style="background-color: #fea543; color: white; font-family: 'Nunito', sans-serif;">
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="text-align: center;">

                <a class="mx-auto" href="/">
                    <img 
                    src="{{url('/images/logo-header.png')}}" alt="logo"
                    style="height: 100px; object-fit: contain; margin-bottom: 80px; margin-top: 28px;"
                    >
                </a>
                
                <h3> Inserisci i dati per la consegna </h3>
                    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="customer_name"><span>*</span> Nome</label>
                            <input type="text" class="form-control" id="customer_name" placeholder="Nome" name="customer_name" value="{{ old('customer_name') }}">
                        </div>
    
                        <div class="mb-3">
                            <label for="customer_address"><span>*</span> Indirizzo consegna</label>
                            <input type="text" class="form-control" id="customer_address" placeholder="Indirizzo" name="customer_address" value="{{ old('customer_address') }}">
                        </div>
    
                        <div class="mb-3">
                            <label for="customer_email" class="form-label">Email</label>
                            <input class="ms_form" type="text" id="customer_email" name="customer_email">
                        </div>

                        <div>
                            <label for="order_total">Prezzo</label>
                            <div>{{$TotalPrice}}&euro;</div>
                            <input type="hidden" name="order_total" id="order_total" value="{{$TotalPrice}}">
                        </div>

                        <div>
                            <input type="hidden" name="restaurant_id" id="restaurant_id" value="{{$restaurant_id}}">
                            @foreach ($dish_id[0] as $item)
                                <input type="hidden" name="dish_id-{{$item}}" id="dish_id-{{$item}}" value="{{$item}}">
                            @endforeach
                            @foreach ($quantity as $key => $item)
                                <input type="hidden" name="quantity-{{$key}}" id="quantity-{{$key}}" value="{{$item}}">
                            @endforeach
                            {{-- <input type="hidden" name="amount" id="amount" value="{{$quantity}}"> --}}
                        </div>
                        

                        <div class="mb-4 mt-4">
                            <i>Tutti i campi contrassegnati con <span>*</span> sono obbligatori</i>
                        </div>
    
                        <button
                            style="border: 1px solid white; color: #fea543; padding: 5px; background-color: white; border-radius: 5px; font-size: 24px;"
                            type="submit"><span>Conferma</span>
                        </button>
                    </form>
    
            </div>
        </div>
    </div>
</body>
</html>