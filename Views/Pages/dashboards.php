<?php
require_once '../Services/DashboardsService.php';
$service = new DashboardsServices();

?>


<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <div class="text-center mb-4">
                <h1 class="card-title1" style="font-weight:bold; font-size: 1.8em;">Filtrar Por Fechas</h1>
            </div>
            <div class="form-row justify-content-center mt-4">
                <div class="col-md-4 mb-3">
                    <label for="startDate">Fecha de Inicio</label>
                    <input type="date" id="startDate" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="endDate">Fecha de Fin</label>
                    <input type="date" id="endDate" class="form-control">
                </div>
            </div>
            <div class="form-row justify-content-center mt-3">
                <button class="btn btn-danger filtrarFecha">Filtrar</button>
            </div>
        </div>
    </div>
</div>

<style>
  .card-title1 {
    font-weight: bold;
    font-size: 2.5em;
    text-align: center;
    width: 100%;
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
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <!-- PIE CHART -->
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title" style="font-weight:bold">Ventas por Mes</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title" style="font-weight:bold">Compras Por Cliente</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <!-- LINE CHART -->
        <div class="card card-danger collapse">
            <div class="card-header">
                <h3 class="card-title">Line Chart</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <!-- BAR CHART -->
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title" style="font-weight:bold">Compras Por Mes</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="barChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title" style="font-weight:bold">Ventas por Empleado</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
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
  $(function () {
    $(document).on('click', '.filtrarFecha', function() {



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







        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;

        $.ajax({
            url: '../Services/obtener_dashboards.php',
            method: 'GET',
            data: { 
                fecha_inicio: startDate, 
                fecha_fin: endDate 
            },
            dataType: 'json',
            success: function(response) {
                try {
                    if (response.error) {
                        console.error(response.error);
                        return;
                    }

                    // Procesar datos para cada gráfico
                    // Cantidad de Compras
                    var comprasClientesMes = response.cantidadComprasClientesFiltro;
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
                        new Chart(donutChartCanvas, {
                            type: 'doughnut',
                            data: {
                                labels: labelsCompras,
                                datasets: [{
                                    data: dataCompras,
                                    backgroundColor: generateColors(dataCompras.length),
                                }]
                            },
                            options: {
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
                            }
                        });
                    }

                    // Cantidad de Ventas
                    var ventasMes = response.cantidadVentasFiltro;
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

                        var barChartCanvasVentas = $('#barChart').get(0).getContext('2d');
                        new Chart(barChartCanvasVentas, {
                            type: 'bar',
                            data: {
                                labels: labelsVentas,
                                datasets: [{
                                    label: 'Cantidad de Ventas',
                                    backgroundColor: generateColors(dataVentas.length),
                                    borderColor: generateColors(dataVentas.length),
                                    data: dataVentas
                                }]
                            },
                            options: {
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
                            }
                        });
                    }

                    // Ventas por Empleado
                    var ventasEmpleadosMes = response.cantidadVentasEmpleadosFiltro;
                    if (ventasEmpleadosMes.error) {
                        console.error(ventasEmpleadosMes.error);
                    } else {
                        var labelsEmpleados = ventasEmpleadosMes.map(function(item) {
                            return item.emp_nombre;
                        });
                        var dataEmpleados = ventasEmpleadosMes.map(function(item) {
                            return item.cantidadVentas;
                        });

                        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
                        new Chart(pieChartCanvas, {
                            type: 'pie',
                            data: {
                                labels: labelsEmpleados,
                                datasets: [{
                                    data: dataEmpleados,
                                    backgroundColor: generateColors(dataEmpleados.length),
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
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
                            }
                        });
                    }

                    // Compras por Mes
                    var comprasMes = response.cantidadComprasFiltro;
                    if (comprasMes.error) {
                        console.error(comprasMes.error);
                    } else {
                        var monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                        var labelsComprasMes = comprasMes.map(function(item) {
                            return monthNames[item.Mes - 1] + ' ' + item.Anio;
                        });
                        var dataComprasMes = comprasMes.map(function(item) {
                            return item.CantidadCompras;
                        });

                        var barChartCanvasCompras = $('#barChart1').get(0).getContext('2d');
                        new Chart(barChartCanvasCompras, {
                            type: 'bar',
                            data: {
                                labels: labelsComprasMes,
                                datasets: [{
                                    label: 'Cantidad de Compras',
                                    backgroundColor: generateColors(dataComprasMes.length),
                                    borderColor: generateColors(dataComprasMes.length),
                                    data: dataComprasMes
                                }]
                            },
                            options: {
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
                            }
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
    });

    // Función para generar colores
    function generateColors(length) {
        var colors = ['#c80b0b', '#848484', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
        var generatedColors = [];
        for (var i = 0; i < length; i++) {
            generatedColors.push(colors[i % colors.length]);
        }
        return generatedColors;
    }
  });
</script>
