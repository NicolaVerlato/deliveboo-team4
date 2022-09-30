<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <h1>Nuovo ordine</h1>
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
    
                        <div class="mb-2">
                            <i>Tutti i campi contrassegnati con <span>*</span> sono obbligatori</i>
                        </div>

                        <div>
                            <label for="order_total">Prezzo</label>
                            <input type="text" name="order_total" id="order_total">
                        </div>
    
                        <button type="submit" class="btn d-block mt-2 btn-primary">Submit</button>
                    </form>
    
            </div>
        </div>
    </div>
</body>
</html>