@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="text-center">
            <a href="{{ route('admin.chartjs.index') }}"><button>Statistiche annuali</button></a>
        </div>
        <div class="col-md-10 offset-md-1">
            <h1>Ciao, hai guadagnato {{$totalOrders}}&euro; questo mese</h1>
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>
    
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    var month = <?php echo $month; ?>;
    var order = <?php echo $order; ?>;
    var quantity = <?php echo $quantity; ?>;
    var barChartData = {
        labels: month,
        datasets: [{
            label: 'Euro',
            backgroundColor: '#fba54f',
            data: order 
        },
        {
            label: 'Quantità',
            backgroundColor: '#2f4858',
            data: quantity 
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                scales: {
                yAxes: [
                  {
                    scaleLabel: {
                      display: true,
                      labelString: "Euro",
                    },
                    
                  },
                ],
                xAxes: [
                  {
                    scaleLabel: {
                      display: true,
                      labelString: "Giorni",
                    },
                  },
                ],
              },
                responsive: true,
                title: {
                    display: true,
                    text: 'Riepilogo guadagni ristorante mensile'
                }
            }
        });
    };
    
</script>
@endsection