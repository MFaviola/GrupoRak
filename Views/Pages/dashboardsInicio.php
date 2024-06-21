<?php
require_once '../Services/DashboardsService.php';
$service = new DashboardsServices();

try {
    $cantidadvehiculos = $service->cantidadVehiculos();
    $cantidadmarcas = $service->cantidadMarcas();
    $cantidadventas = $service->cantidadVentas();
    $cantidadcompras = $service->cantidadCompras();

    $cantidadmodelos = $service->cantidadModelos();
    $cantidadempleados = $service->cantidadEmpleados();
    $cantidadclientes = $service->cantidadClientes();
    $cantidadsedes = $service->cantidadSedes();

    $top5Empleados = $service->top5Empleados();
    $top5Marcas = $service->top5Marcas();


    $ventasPorMes = $service->cantidadVentasMes();
    // echo json_encode($ventasPorMes);

} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>


<!-- CANTIDADES -->
<div class="card">       
    <div class="row m-2">
        <!-- Tarjetas ajustadas -->
        <div class="col-lg-1 col-md-3 col-sm-6">
            <div class="small-box bg-image">
                <div class="inner">
                    <h3><?php echo $cantidadvehiculos; ?></h3>
                    <p>Vehículos</p>
                </div>
                <div class="icon">
                    <i style="margin-top:-30px" class="ion-android-car"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-1 col-md-3 col-sm-6">
            <div class="small-box bg-image">
                <div class="inner">
                    <h3><?php echo $cantidadventas; ?></h3>
                    <p>Ventas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-1 col-md-3 col-sm-6">
            <div class="small-box bg-image">
                <div class="inner">
                    <h3><?php echo $cantidadcompras; ?></h3>
                    <p>Compras</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-1 col-md-3 col-sm-6">
            <div class="small-box bg-image">
                <div class="inner">
                    <h3><?php echo $cantidadmarcas; ?></h3>
                    <p>Marcas</p>
                </div>
                <div class="icon">
                    <i style="margin-top:-30px" class="ion-ios-speedometer"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-1 col-md-3 col-sm-6">
            <div class="small-box bg-image">
                <div class="inner">
                    <h3><?php echo $cantidadmodelos; ?></h3>
                    <p>Modelos</p>
                </div>
                <div class="icon">
                    <i class="ion ion-model-s"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-1 col-md-3 col-sm-6">
            <div class="small-box bg-image">
                <div class="inner">
                    <h3><?php echo $cantidadempleados; ?></h3>
                    <p>Empleados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-1 col-md-3 col-sm-6">
            <div class="small-box bg-image">
                <div class="inner">
                    <h3><?php echo $cantidadclientes; ?></h3>
                    <p>Clientes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-1 col-md-3 col-sm-6">
            <div class="small-box bg-image">
                <div class="inner">
                    <h3><?php echo $cantidadsedes; ?></h3>
                    <p>Sedes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-location"></i>
                </div>
            </div>
        </div>
    </div>

           <!-- New larger boxes for top 5 -->
           <div class="row m-2">
    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title" style="font-weight:bold">Top 5 Marcas Más Vendidas</h3>
            </div>
            <div class="card-body">
                <ul id="top5-automoviles" class="list-group">
                    <?php foreach ($top5Marcas as $marca): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-car"></i> <?php echo $marca['Mar_Descripcion']; ?></span>
                            <span class="badge badge-primary badge-pill"><?php echo $marca['cantidadVendida']; ?> unidades</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title" style="font-weight:bold">Top 5 Empleados del Mes</h3>
            </div>
            <div class="card-body">
                <ul id="top5-empleados" class="list-group">
                    <?php foreach ($top5Empleados as $empleado): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-user"></i> <?php echo $empleado['emp_nombre']; ?></span>
                            <span class="badge badge-primary badge-pill">L. <?php echo $empleado['totalVendido']; ?> vendidos</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    .small-box {
        height: 120px;
    }
    .col-lg-1 {
        flex: 0 0 auto;
        max-width: 12.5%;
    }
    .col-md-3 {
        max-width: 12.5%;
    }
    .col-sm-6 {
        max-width: 12.5%;
    }
</style>

 



        <div class="row">
          <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-danger collapse">
              <div class="card-header">
                <h3 class="card-title">Area Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- DONUT CHART -->

            
            <!-- /.card -->

            <!-- PIE CHART -->
            <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title" style="font-weight:bold">Ventas por Mes</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button> -->
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
            <!-- /.card -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title" style="font-weight:bold">Compras Por Cliente</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
          </div>

          
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-danger collapse">
              <div class="card-header">
                <h3 class="card-title">Line Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- BAR CHART -->
            <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title" style="font-weight:bold">Compras Por Mes</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button> -->
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="barChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
            <!-- /.card -->

            <!-- STACKED BAR CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title" style="font-weight:bold">Ventas por Empleado</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>

      
<style>
  .bg-image
  {
    color: white;
    background-image: url(https://www.ppt-backgrounds.net/images/dark-red-gradient-slides-templates-ppt-templates.jpg);
  }

  .bg-rojoo
  {
    color: white;
    background-color: #ba0201;
  }

  .card-danger:not(.card-outline) > .card-header {
  background-color: #000;
  color: white
  }

</style>
        



<script src="../Views/Resources/plugins/jquery/jquery.min.js"></script>
<script src="../Views/Resources/plugins/chart.js/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<script>



$(document).ready(function() {

$("#inicio").addClass('active');
$("#dashboardsInicio").addClass('active');

});



  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(138,8,8,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    $.ajax({
    url: '../Services/obtener_dashboardsInicio.php',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
        try {
            if (response.error) {
                console.error(response.error);
                return;
            }

            // Manejar comprasClientesMes
            var comprasClientesMes = response.comprasClientesMes;
            if (comprasClientesMes.error) {
                console.error(comprasClientesMes.error);
            } else {
                var labelsCompras = comprasClientesMes.map(function(item) {
                    return item.cli_nombre;
                });
                var dataCompras = comprasClientesMes.map(function(item) {
                    return item.cantidadCompras;
                });

                var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
                var donutData1 = {
                    labels: labelsCompras,
                    datasets: [{
                        data: dataCompras,
                        backgroundColor: ['#c80b0b', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                    }]
                };

                var donutOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        datalabels: {
                            color: '#fff',
                            display: function(context) {
                                return context.dataset.data[context.dataIndex] > 0;
                            },
                            font: {
                                weight: 'bold'
                            },
                            formatter: Math.round
                        }
                    }
                };

                new Chart(donutChartCanvas, {
                    type: 'doughnut',
                    data: donutData1,
                    options: donutOptions
                });
            }

        } catch (e) {
            console.error('Error parsing response:', e);
        }
    },
    error: function(xhr, status, error) {
        console.error(error);
    }
});
var donutData        = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#c80b0b', '#848484', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    $.ajax({
    url: '../Services/obtener_dashboardsInicio.php',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
        try {
            if (response.error) {
                console.error(response.error);
                return;
            }

            // Manejar ventasEmpleadosMes
            var ventasEmpleadosMes = response.ventasEmpleadosMes;
            if (ventasEmpleadosMes.error) {
                console.error(ventasEmpleadosMes.error);
            } else {
                var labelsVentas = ventasEmpleadosMes.map(function(item) {
                    return item.emp_nombre;
                });
                var dataVentas = ventasEmpleadosMes.map(function(item) {
                    return item.cantidadVentas;
                });

                var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
                var pieData = {
                    labels: labelsVentas,
                    datasets: [{
                        data: dataVentas,
                        backgroundColor: ['#c80b0b', '#848484', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                    }]
                };

                var pieOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        datalabels: {
                            color: '#fff',
                            display: function(context) {
                                return context.dataset.data[context.dataIndex] > 0;
                            },
                            font: {
                                weight: 'bold'
                            },
                            formatter: Math.round
                        }
                    }
                };

                new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                });
            }

        } catch (e) {
            console.error('Error parsing response:', e);
        }
    },
    error: function(xhr, status, error) {
        console.error(error);
    }
});
    //-------------
    //- BAR CHART -
    //-------------
    $.ajax({
    url: '../Services/obtener_dashboardsInicio.php',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
        try {
            if (response.error) {
                console.error(response.error);
                return;
            }

            // Manejar cantidadVentasMes
            var ventasMes = response.ventasMes;
            if (ventasMes.error) {
                console.error(ventasMes.error);
            } else {
                var monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                var labelsVentas = ventasMes.map(function(item) {
                    return monthNames[item.Mes - 1] + ' ' + item.Anio;
                });
                var dataVentas = ventasMes.map(function(item) {
                    return item.CantidadVentas;
                });

                // Conjunto de colores
                var colors = [
                    'rgba(201,1,1,0.9)',
                    'rgba(1,102,255,0.9)',
                    'rgba(1,201,1,0.9)',
                    'rgba(255,165,0,0.9)',
                    'rgba(201,1,255,0.9)',
                    'rgba(255,215,0,0.9)',
                    'rgba(0,128,128,0.9)',
                    'rgba(128,0,128,0.9)',
                    'rgba(255,69,0,0.9)',
                    'rgba(75,0,130,0.9)',
                    'rgba(255,20,147,0.9)',
                    'rgba(0,255,127,0.9)'
                ];

                var barChartCanvas = $('#barChart').get(0).getContext('2d');
                var barChartData = {
                    labels: labelsVentas,
                    datasets: [{
                        label: 'Cantidad de Ventas',
                        backgroundColor: labelsVentas.map((_, index) => colors[index % colors.length]),
                        borderColor: labelsVentas.map((_, index) => colors[index % colors.length]),
                        data: dataVentas
                    }]
                };

                var barChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false,
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                            color: '#444',
                            font: {
                                weight: 'bold'
                            },
                            formatter: Math.round
                        }
                    }
                };

                new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                });
            }

        } catch (e) {
            console.error('Error parsing response:', e);
        }
    },
    error: function(xhr, status, error) {
        console.error(error);
    }
});


$.ajax({
    url: '../Services/obtener_dashboardsInicio.php',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
        try {
            if (response.error) {
                console.error(response.error);
                return;
            }

            // Manejar cantidadComprasMes
            var comprasMes = response.comprasMes;
            if (comprasMes.error) {
                console.error(comprasMes.error);
            } else {
                var monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                var labelsCompras = comprasMes.map(function(item) {
                    return monthNames[item.Mes - 1] + ' ' + item.Anio;
                });
                var dataCompras = comprasMes.map(function(item) {
                    return item.CantidadCompras;
                });

                // Conjunto de colores
                var colors = [
                    'rgba(201,1,1,0.9)',
                    'rgba(1,102,255,0.9)',
                    'rgba(1,201,1,0.9)',
                    'rgba(255,165,0,0.9)',
                    'rgba(201,1,255,0.9)',
                    'rgba(255,215,0,0.9)',
                    'rgba(0,128,128,0.9)',
                    'rgba(128,0,128,0.9)',
                    'rgba(255,69,0,0.9)',
                    'rgba(75,0,130,0.9)',
                    'rgba(255,20,147,0.9)',
                    'rgba(0,255,127,0.9)'
                ];

                var barChartCanvasCompras = $('#barChart1').get(0).getContext('2d');
                var barChartDataCompras = {
                    labels: labelsCompras,
                    datasets: [{
                        label: 'Cantidad de Compras',
                        backgroundColor: labelsCompras.map((_, index) => colors[index % colors.length]),
                        borderColor: labelsCompras.map((_, index) => colors[index % colors.length]),
                        data: dataCompras
                    }]
                };

                var barChartOptionsCompras = {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false,
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                            color: '#444',
                            font: {
                                weight: 'bold'
                            },
                            formatter: Math.round
                        }
                    }
                };

                new Chart(barChartCanvasCompras, {
                    type: 'bar',
                    data: barChartDataCompras,
                    options: barChartOptionsCompras
                });
            }

        } catch (e) {
            console.error('Error parsing response:', e);
        }
    },
    error: function(xhr, status, error) {
        console.error(error);
    }
});


    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>