@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('content')
    <label class="mt-3">Seleccione las fechas de reporte:</label>
    <br>
    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 33%">
        <i class="fa fa-calendar"></i>&nbsp;
        <span></span> <i class="fa fa-caret-down"></i>
    </div>

    <div class="row mt-2">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <p for="">Total ventas</p>
                    <span id="totalVentas">0</span>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <p for="">Total productos vendidos</p>
                    <span id="totalProductos">0</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="totalIngresos"></canvas>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="totalProductosDou"></canvas>
                </div>
            </div>
        </div>
        
    </div>

@section('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script type="text/javascript">
        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

                $.ajax({
                    url: '/obtenerReportes?fechaInicio=' + start.format('YYYY[-]MM[-]DD') + '&fechaFin=' +
                        end.format('YYYY[-]MM[-]DD'),
                    type: 'GET',
                    success: function(response) {
                        // alert(response);
                        console.log(response)
                        setData(response)
                    },
                });
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });

        function setData(response) {
            if (window.myChart != null) {
                // Si existe, destruirlo antes de crear uno nuevo
                window.myChart.destroy();
            }

            if (window.myChartDou != null) {
                // Si existe, destruirlo antes de crear uno nuevo
                window.myChartDou.destroy();
            }

            const totalVentas = document.getElementById('totalVentas')
            const totalProductos = document.getElementById('totalProductos')

            totalProductos.innerHTML = response.totalProductos

            totalVentas.innerHTML = new Intl.NumberFormat('es-CO', {
                style: 'currency',
                currency: 'COP',
                minimumFractionDigits: 0
            }).format(response.totalVentas);

            const totalIngresos = response.totalGrafica

            // Obtener el elemento canvas
            var ctx = document.getElementById('totalIngresos').getContext('2d');

            // Configuración de opciones del gráfico
            var options = { height:300,
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            };

            // Datos del gráfico
            var data = {
                labels: totalIngresos.map((t) => t.date),
                datasets: [{
                    label: 'Total Ingresos',
                    data: totalIngresos.map((t) => t.total_price),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            };

            console.log(data)

            // Crear instancia del objeto Chart
            window.myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });


            const totalProductosDou = response.totalVendidos



            var ctxDou = document.getElementById('totalProductosDou').getContext('2d');

            window.myChartDou = new Chart(ctxDou, {
                type: 'doughnut',
                data: {
                    labels: totalProductosDou.map((t) => t.name),
                    datasets: [{
                        label: 'My First Dataset',
                        data: totalProductosDou.map((t) => t.stockDetail),
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    height:300
                }
            });
        }
    </script>
@endsection
@endsection
