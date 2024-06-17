<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pantalla de Facturación</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            margin: 20px;
        }
        .invoice-header {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .invoice-details {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .car-info {
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .car-info h4 {
            margin-bottom: 15px;
        }
        .totals {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoice-header">
            <h2>Factura</h2>
            <div class="row">
                <div class="col-md-4">
                    <label for="DNI">DNI</label>
                    <input type="text" id="DNI" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="Cliente">Cliente</label>
                    <input type="text" id="Cliente" class="form-control" readonly>
                </div>
                <div class="col-md-4">
                    <label for="MetodoPago">Método de Pago</label>
                    <select id="MetodoPago" class="form-control">
                        <option value="">Seleccione un Método de Pago</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="Descuento">Descuento</label>
                    <select id="Descuento" class="form-control">
                        <option value="">Seleccione un Descuento</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="invoice-details">
                    <h3>Detalles de la Factura</h3>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="Placa">Placa</label>
                            <input type="text" id="Placa" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="Precio">Precio</label>
                            <input type="number" step="0.01" id="Precio" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="Impuesto">Impuesto (%)</label>
                            <input type="number" step="0.01" id="Impuesto" class="form-control">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button id="AgregarDetalle" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Vehículo (Placa)</th>
                                <th>Precio</th>
                                <th>Impuesto</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="DetalleFacturaBody">
                            <!-- Aquí se insertarán las filas de detalles -->
                        </tbody>
                    </table>
                    <div class="totals">
                        <h5>Subtotal: <span id="Subtotal">0.00</span> Lps</h5>
                        <h5>Total: <span id="Total">0.00</span> Lps</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="car-info">
                    <h4>Detalles del Vehículo</h4>
                    <p><strong>Placa:</strong> <span id="Veh_Placa"></span></p>
                    <p><strong>Color:</strong> <span id="Veh_Color"></span></p>
                    <p><strong>Precio:</strong> <span id="Veh_Precio"></span> Lps</p>
                    <p><strong>Modelo:</strong> <span id="Modelo_Descripcion"></span></p>
                    <p><strong>Año:</strong> <span id="Modelo_Año"></span></p>
                    <p><strong>Marca ID:</strong> <span id="Marca_Id"></span></p>
                    <img id="Veh_Imagen" src="" alt="Imagen del Vehículo" style="width:200px;"/>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let subtotalGlobal = 0;
            let totalGlobal = 0;

            // Autocompletar el cliente basado en el DNI
            $('#DNI').on('change', function() {
                const dni = $(this).val();
                if (dni) {
                    $.ajax({
                        url: 'Services/CarService.php',
                        method: 'POST',
                        data: {
                            action: 'obtenerClientePorDNI',
                            dni: dni
                        },
                        success: function(response) {
                            const data = JSON.parse(response);
                            if (data.error) {
                                $('#Cliente').val('Cliente no encontrado');
                            } else {
                                $('#Cliente').val(`${data.Cli_Nombre} ${data.Cli_Apellido}`);
                            }
                        },
                        error: function(error) {
                            console.error('Error al obtener el cliente', error);
                            $('#Cliente').val('Error al obtener el cliente');
                        }
                    });
                } else {
                    $('#Cliente').val('');
                }
            });

            // Cargar métodos de pago en el DDL
            function cargarMetodosPago() {
                $.ajax({
                    url: 'Services/CarService.php',
                    method: 'POST',
                    data: {
                        action: 'listarMetodosPago'
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        $('#MetodoPago').empty().append('<option value="">Seleccione un Método de Pago</option>');
                        data.forEach(item => {
                            $('#MetodoPago').append(new Option(item.Mpg_Descripcion, item.Mpg_ID));
                        });
                    },
                    error: function(error) {
                        console.error('Error al listar métodos de pago', error);
                    }
                });
            }

            // Cargar descuentos en el DDL
            function cargarDescuentos() {
                $.ajax({
                    url: 'Services/CarService.php',
                    method: 'POST',
                    data: {
                        action: 'listarDescuentos'
                    },
                    success: function(response) {
                        const data = JSON.parse(response);
                        $('#Descuento').empty().append('<option value="">Seleccione un Descuento</option>');
                        data.forEach(item => {
                            $('#Descuento').append(new Option(item.Des_Descripcion, item.Des_ID));
                        });
                    },
                    error: function(error) {
                        console.error('Error al listar descuentos', error);
                    }
                });
            }

            // Llamar las funciones de carga de DDL
            cargarMetodosPago();
            cargarDescuentos();

            // Manejar la búsqueda del vehículo y mostrar sus detalles
            $('#Placa').on('change', function() {
                const placa = $(this).val();
                if (placa) {
                    $.ajax({
                        url: 'Services/CarService.php',
                        method: 'POST',
                        data: {
                            action: 'obtenerCarroPorPlaca',
                            placa: placa
                        },
                        success: function(response) {
                            const data = JSON.parse(response);
                            if (data.error) {
                                alert('Vehículo no encontrado');
                            } else {
                                mostrarDetallesVehiculo(data);
                                $('#Precio').val(data.Veh_Precio); // Autocompletar precio
                            }
                        },
                        error: function(error) {
                            console.error('Error al obtener los detalles del vehículo', error);
                        }
                    });
                }
            });

            // Mostrar los detalles del vehículo en la tarjeta
            function mostrarDetallesVehiculo(data) {
                $('#Veh_Placa').text(data.Veh_Placa);
                $('#Veh_Color').text(data.Veh_Color);
                $('#Veh_Precio').text(data.Veh_Precio);
                $('#Modelo_Descripcion').text(data.Modelo_Descripcion);
                $('#Modelo_Año').text(data.Modelo_Año);
                $('#Marca_Id').text(data.Marca_Id);
                $('#Veh_Imagen').attr('src', data.Veh_Imagen);
            }

            // Agregar detalles a la factura
            $('#AgregarDetalle').on('click', function() {
                const placa = $('#Placa').val();
                const precio = parseFloat($('#Precio').val());
                const impuesto = parseFloat($('#Impuesto').val());

                if (!placa || !precio || isNaN(impuesto)) {
                    alert('Por favor, complete todos los campos.');
                    return;
                }

                const subtotal = precio;
                const totalImpuesto = subtotal * (impuesto / 100);
                const total = subtotal + totalImpuesto;

                subtotalGlobal += subtotal;
                totalGlobal += total;

                const fila = `
                    <tr>
                        <td>${placa}</td>
                        <td>${precio.toFixed(2)} Lps</td>
                        <td>${impuesto.toFixed(2)} %</td>
                        <td>${total.toFixed(2)} Lps</td>
                        <td><button class="btn btn-danger btn-sm eliminar-detalle">Eliminar</button></td>
                    </tr>
                `;
                $('#DetalleFacturaBody').append(fila);
                actualizarTotales();
            });

            // Manejar la eliminación de filas de detalle
            $('#DetalleFacturaBody').on('click', '.eliminar-detalle', function() {
                const fila = $(this).closest('tr');
                const subtotal = parseFloat(fila.find('td:eq(3)').text());

                subtotalGlobal -= subtotal / (1 + parseFloat(fila.find('td:eq(2)').text()) / 100);
                totalGlobal -= subtotal;

                fila.remove();
                actualizarTotales();
            });

            // Actualizar los totales de la factura
            function actualizarTotales() {
                $('#Subtotal').text(subtotalGlobal.toFixed(2));
                $('#Total').text(totalGlobal.toFixed(2));
            }
        });
    </script>
</body>
</html>
