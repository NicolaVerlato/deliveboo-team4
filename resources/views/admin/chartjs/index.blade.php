@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="text-center">
            <a href="{{ route('admin.chartjs.show', ['chartj' => 0]) }}"><button>Statistiche mensili</button></a>
        </div>
        <div class="col-md-10 offset-md-1">
            <h1>Ciao, hai guadagnato {{$totalOrders}}&euro; quest'anno</h1>
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
    var barChartData = {
        labels: month,
        datasets: [{
            label: 'Euro',
            backgroundColor: [
          "#566573",
          "#99a3a4",
          "#dc7633",
          "#f5b041",
          "#f7dc6f",
          "#82e0aa",
          "#73c6b6",
          "#5dade2",
          "#a569bd",
          "#ec7063",
          "#a5754a",
          '#fba54f'
        ],
            data: order
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'pie',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Riepilogo guadagni ristorante annuale'
                }
            }
        });
    };
    
</script>

@endsection