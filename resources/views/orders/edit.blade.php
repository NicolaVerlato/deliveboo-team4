<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='/stylesheets/style.css' />
    <!-- includes the Braintree JS client SDK -->
    <script src="https://js.braintreegateway.com/web/dropin/1.33.4/js/dropin.min.js"></script>
    <!-- includes jQuery -->
    <script src="http://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dati pagamento</title>
</head>

<body style="background-color: #fea543; color: white; font-family: 'Nunito', sans-serif;">

  <a style="padding-top: 10px;" href="/">
    <img 
    src="{{url('/images/logo-header.png')}}" alt="logo"
    style="height: 100px; object-fit: contain;display: block;margin: auto;margin-bottom: 80px; padding-top: 10px;"
    >
  </a>

  <form method="POST" id="payment-form" action="{{route('orders.update', $order->id)}}" class="mx-auto">
    @csrf
    @method('PUT')
    <input type="hidden" name="order_id" id="order_id" value="{{$order->id}}">
    <section class="mt-6 mb-3">
      <div class="card-header" id="payment-form-bg" style="font-size: 20px;">
        <h3 class="text-center text-2xl text-gray-800" style="text-align: center;">Ordine effettuato da: 
            <span>
              {{$order->customer_name}}
            </span>
        </h3>
        <label for="amount" class="flex justify-center space-x-2">
          <h5 style="text-align: center;">
            <span class="input-label text-gray-800 text-lg">Prezzo totale:</span>
            <span class="text-lg text-gray-800">{{number_format($order->order_total, 2, '.', ',')}} &euro; </span>
          </h5>
        </label>
      </div>
    
      <div class="bt-drop-in-wrapper">
        <div id="bt-dropin"></div>
      </div>
    </section>
    
      <input id="nonce" name="payment_method_nonce" type="hidden" />
      <div style="text-align: center;">
        <button
        style="border: 1px solid white; color: #fea543; padding: 5px; background-color: white; border-radius: 5px; font-size: 24px; margin-top: 15px;"
        type="submit"><span>Paga Ora</span>
        </button>
      </div>
  </form>

  <script src="https://js.braintreegateway.com/web/dropin/1.33.1/js/dropin.min.js"></script>
    
  <script>
    // var button = document.querySelector('#submit-button');
    var form = document.querySelector('#payment-form');
    var client_token = "{{$token}}";

    braintree.dropin.create({
      // Insert your tokenization key here
      authorization: 'sandbox_csmtxxwr_6k6m4rt6hmfwpqcf',
      selector: '#bt-dropin',
      // container: '#dropin-container'
    }, function (createErr, instance) {
    if (createErr) {
    console.log('Create Error', createErr);
    return;
    }
    form.addEventListener('submit', function (event) {
    event.preventDefault();
    let button = document.querySelector('button');
    button.disabled=true;
    instance.requestPaymentMethod(function (err, payload) {
    if (err) {
    console.log('Request Payment Method Error', err);
    return;
    }
    // Add the nonce to the form and submit
    document.querySelector('#nonce').value = payload.nonce;
    form.submit();
    });
    });
    });
  </script>

</body>
</html>