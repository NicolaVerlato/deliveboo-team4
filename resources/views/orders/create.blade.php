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

                <h2 
                style="margin-bottom: 50px; font-size: 35px; text-align: center; margin-top: 28px;">
                    <strong>Deliveb<i class="fa-solid fa-cookie-bite"></i><i class="fa-solid fa-cookie-bite"></i>
                    </strong>
                </h2>
                
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
                            <input type="text" name="order_total" id="order_total">
                        </div>

                        <div class="mb-4 mt-4">
                            <i>Tutti i campi contrassegnati con <span>*</span> sono obbligatori</i>
                        </div>
    
                        <button
                            style="border: 2px solid white; color: white; padding: 5px; background-color: transparent; border-radius: 5px; font-size: 20px;"
                            type="submit"><span>Conferma</span>
                        </button>
                    </form>
    
            </div>
        </div>
    </div>
</body>
</html>