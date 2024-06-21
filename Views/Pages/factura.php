<?php
require_once '../Services/VentaService.php';

$ventasService = new VentaService();

try {
    $venta = $ventasService->listar();

    $vehiculos = $ventasService->listarVehiculos();
    $metodosPago = $ventasService->listarMetodosPago();
    if (!is_array($metodosPago)) {
        throw new Exception("No se pudo obtener una lista de métodos de pago.");
    }
} catch (Exception $e) {
    $errorMsg = 'Error al cargar los métodos de pago o vehículos: ' . $e->getMessage();
    $metodosPago = [];
    $vehiculos = [];
}

$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
$mensaje_tipo = isset($_SESSION['mensaje_tipo']) ? $_SESSION['mensaje_tipo'] : '';
unset($_SESSION['mensaje']);
unset($_SESSION['mensaje_tipo']);
?>

 <title>Facturación</title>
    <style>
        #detalleFactura thead th {
            background-color: #000; 
            color: #fff; 
        }

        .modal-lg {
            max-width: 90% !important;
        }
        
        .card {
            margin: 20px 0;
        }
        
        .card-header {
            background-color: #000;
            color: #fff;
            font-size: 1.25em;
            padding: 10px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
    <!-- jQuery -->
 
    <!-- Bootstrap 4 -->
    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>





    <div id="tabla">
    <div class="card">
        <div class="card-body">
            <h2 class="text-center" style="font-size:34px !important">Ventas</h2>

            <button class="btn btn-primary" id="btnNuevo">
                <i class="fa-solid fa-plus"></i>
                Nuevo
            </button>
            <hr>
            <table id="example1" class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Metodo de Pago</th>
                        <th>Sede</th>
                        <th>Atendido Por</th>


                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($venta as $venta) : ?>
                        <tr>
                            <td><?php echo $venta['Vnt_ID']; ?></td>
                            <td><?php echo $venta['Vnt_Fecha']; ?></td>
                            <td><?php echo $venta['Cliente']; ?></td>
                            <td><?php echo $venta['Metodo_Pago']; ?></td>
                            <td><?php echo $venta['Sede']; ?></td>
                            <td><?php echo $venta['Cliente']; ?></td>

                            <td class="d-flex justify-content-center" style="gap:10px">

                            <button type="button" class="btn btn-primary" id="btnImprimirFactura"><i class="fa-solid fa-check"></i>Imprimir</button>
                            <!-- <button class="btn btn-danger btn-sm"><i class="fas fa-eraser"></i> Eliminar</button> -->

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>






    

<div class="container mt-5" id="insertarEncabezado">
    <div class="card">
        <div class="card-header text-center">
            Facturación
        </div>



        
        <div class="card-body">
            <?php if (!empty($mensaje)): ?>
                <div class="alert alert-<?php echo $mensaje_tipo; ?>" role="alert">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>


            
            <form id="frmFactura" method="POST" action="facturacion_procesar.php">
                <div class="row">
                    <div class="col-md-4">
                        <input type="hidden" id="empleado" name="empleado" value="1">
                        <div class="form-group">
                            <label>DNI del Cliente</label>
                            <input type="text" class="form-control" id="dniCliente" name="dniCliente" placeholder="Ingrese el DNI">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="hidden" id="fechaCreacion" name="fechaCreacion" value="<?php echo date('Y-m-d'); ?>">
                        <div class="form-group">
                            <label>Nombre del Cliente</label>
                            <input type="text" class="form-control" id="nombreCliente" placeholder="Seleccionar Cliente" readonly>
                            <input type="hidden" id="Cli_ID" name="Cli_ID">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="hidden" id="sede" name="sede" value="1">
                        <div class="form-group">
                            <label>Método de Pago</label>
                            <select class="form-control" id="metodoPagoSelect" name="metodoPagoSelect" required>
                                <option value="">Seleccione</option>
                                <?php if (empty($metodosPago)) : ?>
                                    <option value="" disabled>No hay métodos de pago disponibles</option>
                                <?php else : ?>
                                    <?php foreach ($metodosPago as $metodoPago) : ?>
                                        <option value="<?php echo $metodoPago['Mpg_ID']; ?>"><?php echo $metodoPago['Mpg_Descripcion']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Descuento</label>
                            <select class="form-control" id="descuentoSelect" name="descuentoSelect" required>
                                <option value="0">0%</option>
                                <option value="1">5%</option>
                                <option value="2">10%</option>
                                <option value="3">15%</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Filtrar por Placa</label>
                            <input type="text" class="form-control" id="filtrarPlaca" name="filtrarPlaca" placeholder="Filtrar por Placa">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-danger mt-4" id="btnAgregarProducto"><i class="fa-solid fa-car"></i> Agregar Vehículo</button>
                    </div>
                </div>
                <hr>
                <div class="card card-danger">

                <table id="detalleFactura" class="table table-bordered table-striped">
                <div class="card-header">

                <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Placa</th>
                            <th>Vehículo</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </div>
                    <tbody>
                    </tbody>
                </table>
                <div class="text-right">
                    <p><strong>Subtotal:</strong> <span id="subtotal">L 0.00</span></p>
                    <p><strong>ISV (15%):</strong> <span id="isv15">L 0.00</span></p>
                    <p><strong>Descuento:</strong> <span id="descuento">L 0.00</span></p>
                    <p><strong>Total a Pagar:</strong> <span id="totalPagar">L 0.00</span></p>
                </div>
                </div>
                <div class="card-footer">
                <div class="d-flex justify-content-end" style="gap:10px">

                <button type="button" class="btn btn-primary" id="btnImprimirFactura"><i class="fa-solid fa-check"></i>Imprimir</button>
                <button type="button" class="btn btn-danger" id="btnCancelarFactura"><i class="fa-solid fa-xmark"></i>Cancelar</button>
                </div>
                </div>

            </form>
        </div>
    </div>
</div>







<!-- Modal para Buscar Vehículos -->
<div class="modal fade" id="modalVehiculos" tabindex="-1" role="dialog" aria-labelledby="modalVehiculosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" >
                <h5 class="modal-title" id="modalVehiculosLabel">Lista de Vehículos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tablaVehiculos" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Placa</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Marca</th>
                            <th>Color</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($vehiculos as $vehiculo) : ?>
                        <tr>
                            <td><?php echo $vehiculo['Veh_Placa']; ?></td>
                            <td><?php echo $vehiculo['Modelo']; ?></td>
                            <td><?php echo $vehiculo['Año']; ?></td>
                            <td><?php echo $vehiculo['Marca']; ?></td>
                            <td><?php echo $vehiculo['Veh_Color']; ?></td>
                            <td><?php echo $vehiculo['Precio']; ?></td>
                            <td>
                                <button class="btn btn-danger btn-sm seleccionar-vehiculo" 
                                    data-placa="<?php echo $vehiculo['Veh_Placa']; ?>" 
                                    data-modelo="<?php echo $vehiculo['Modelo']; ?>" 
                                    data-color="<?php echo $vehiculo['Veh_Color']; ?>" 
                                    data-precio="<?php echo $vehiculo['Precio']; ?>">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="../Views/Resources/plugins/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() {
    let ventaId = 0;
    $("#insertarEncabezado").hide();

     // Inicialización de DataTables
     var table = $("#example1").DataTable({
        "responsive": false,
        "lengthChange": false,
        "autoWidth": false,
    });

    

    var table2 = $("#tablaVehiculos").DataTable({
        "responsive": false,
        "lengthChange": false,
        "autoWidth": false,
    });


    $("#dniCliente").on("keyup", function() {
        const dni = $(this).val();
        if (dni.length === 13) {
            $.ajax({
                url: '../Services/VentaService.php',
                method: 'POST',
                data: {
                    action: 'buscarClientePorDNI',
                    dni: dni
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        $("#nombreCliente").val(response.data.Cli_Nombre + ' ' + response.data.Cli_Apellido);
                        $("#Cli_ID").val(response.data.Cli_ID);
                    } else {
                        alert(response.message);
                        $("#nombreCliente").val('');
                        $("#Cli_ID").val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error en la solicitud AJAX de cliente:", error);
                }
            });
        }
    });

    $("#btnAgregarProducto").click(function() {
        if ($("#dniCliente").val() === '' || $("#metodoPagoSelect").val() === '') {
            alert('Debe ingresar el DNI del cliente y seleccionar un método de pago.');
            return;
        }

        if (ventaId === 0) {
            insertarVenta();
        } else {
            $("#modalVehiculos").modal('show');
        }
    });

    $("#filtrarPlaca").on("keyup", function() {
        const placa = $(this).val();
        if (placa.length > 0) {
            $.ajax({
                url: '../Services/VentaService.php',
                method: 'POST',
                data: {
                    action: 'buscarVehiculoPorPlaca',
                    placa: placa
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        agregarVehiculoATabla(response.data);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error en la solicitud AJAX de vehículo:", error);
                }
            });

            
        }
    });







    $(".seleccionar-vehiculo").click(function() {
        var vehiculo = {
            placa: $(this).data('placa'),
            modelo: $(this).data('modelo'),
            color: $(this).data('color'),
            precio: $(this).data('precio'),
        };
        agregarVehiculoATabla(vehiculo);
        $("#modalVehiculos").modal('hide');
    });

    function agregarVehiculoATabla(vehiculo) {
        var newRow = `
            <tr>
                <td>${$("#detalleFactura tbody tr").length + 1}</td>
                <td>${vehiculo.placa}</td>
                <td>${vehiculo.modelo} (${vehiculo.color})</td>
                <td>${vehiculo.precio}</td>
                <td class="subtotal">${vehiculo.precio}</td>
                <td>
                    <button class="btn btn-danger btn-sm eliminar-vehiculo">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        $("#detalleFactura tbody").append(newRow);
        actualizarTotales();
        insertarVentaDetalle(vehiculo.placa, vehiculo.precio);
    }







    $("#btnNuevo").click(function() {
            $("#form-title").text('Nueva Compra');
            $("#id").val('');
            $("#txtNombre").val('');
            $("#txtApellido").val('');
            $("#txtIdentidad").val('');
            $("#txtDireccion").val('');
            $("#txtFechaNacimiento").val('');
            $("input[name='rbSexo']").prop("checked", false);
            $("#departamentoSelect").val('0');
            $("#ciudadSelect").val('0');
            $("#estadoCivilSelect").val('0');
            $("#insertarEncabezado").show();
            $("#insertar").hide();
            $("#detalleCompra").hide();
            $("#tabla").hide();
            encabezadoInsertado = false;
        });






    function actualizarTotales() {
        let subtotal = 0;
        $("#detalleFactura tbody tr").each(function() {
            subtotal += parseFloat($(this).find('.subtotal').text());
        });

        let isv15 = subtotal * 0.15;
        let descuento = subtotal * parseFloat($("#descuentoSelect").val()) / 100;
        let totalPagar = subtotal + isv15 - descuento;

        $("#subtotal").text(`L ${subtotal.toFixed(2)}`);
        $("#isv15").text(`L ${isv15.toFixed(2)}`);
        $("#descuento").text(`L ${descuento.toFixed(2)}`);
        $("#totalPagar").text(`L ${totalPagar.toFixed(2)}`);
    }

    function insertarVenta() {
        $.ajax({
            url: '../Services/VentaService.php',
            method: 'POST',
            data: {
                action: 'insertarVenta',
                fecha: $("#fechaCreacion").val(),
                empId: $("#empleado").val(),
                mpgId: $("#metodoPagoSelect").val(),
                sedId: $("#sede").val(),
                desId: $("#descuentoSelect").val(),
                cliId: $("#Cli_ID").val(),
                impId: 1, // Suponiendo que siempre es 15% como mencionaste
                usuIdCre: 1 // Cambiar según el usuario que esté creando
            },
            dataType: 'json',
            success: function(response) {
                console.log(response); // Añade este log para ver la respuesta del servidor
                if (response.status === 'success') {
                    ventaId = response.data.Vnt_ID;
                    console.log("Venta ID:", ventaId);
                    $("#modalVehiculos").modal('show');
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log("Error en la solicitud AJAX de insertar venta:", error);
            }
        });
    }

    function insertarVentaDetalle(placa, precio) {
        $.ajax({
            url: '../Services/VentaService.php',
            method: 'POST',
            data: {
                action: 'insertarVentaDetalle',
                vntId: ventaId,
                precioVenta: precio,
                vehPlaca: placa,
                usuIdCre: 1 // Cambiar según el usuario que esté creando
            },
            dataType: 'json',
            success: function(response) {
                console.log(response); 
                if (response.status !== 'success') {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log("Error en la solicitud AJAX de insertar detalle de venta:", error);
            }
        });
    }

    $(document).on('click', '.eliminar-vehiculo', function() {
        const vehPlaca = $(this).closest('tr').find('td').eq(1).text();
        $.ajax({
            url: '../Services/VentaService.php',
            method: 'POST',
            data: {
                action: 'eliminarVentaDetalle',
                vehPlaca: vehPlaca
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $(this).closest('tr').remove();
                    actualizarTotales();
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log("Error en la solicitud AJAX de eliminar detalle de venta:", error);
            }
        });
    });

    // Cancelar y limpiar el formulario
    $("#btnCancelarFactura").click(function() {
        $("#tabla").show();
        $("#insertarEncabezado").hide();

        window.location.reload();

        // if (ventaId > 0) {

        //     eliminarVenta();
        // }
        limpiarFormulario();
    });

    function eliminarVenta() {
        $.ajax({
            url: '../Services/VentaService.php',
            method: 'POST',
            data: {
                action: 'eliminarVenta',
                vntId: ventaId
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    console.log("Venta eliminada correctamente");
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log("Error en la solicitud AJAX de eliminar venta:", error);
            }
        });
    }

    function limpiarFormulario() {
        ventaId = 0;
        $("#frmFactura")[0].reset();
        $("#detalleFactura tbody").empty();
        $("#subtotal").text("L 0.00");
        $("#isv15").text("L 0.00");
        $("#descuento").text("L 0.00");
        $("#totalPagar").text("L 0.00");
    }

    function imprimirFactura() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.text("Factura", 20, 10);
        doc.text(`DNI del Cliente: ${$("#dniCliente").val()}`, 20, 20);
        doc.text(`Nombre del Cliente: ${$("#nombreCliente").val()}`, 20, 30);
        doc.text(`Método de Pago: ${$("#metodoPagoSelect option:selected").text()}`, 20, 40);
        doc.text(`Descuento: ${$("#descuentoSelect option:selected").text()}`, 20, 50);

        let startY = 60;
        $("#detalleFactura tbody tr").each(function(index, tr) {
            const placa = $(tr).find("td").eq(1).text();
            const vehiculo = $(tr).find("td").eq(2).text();
            const precio = $(tr).find("td").eq(3).text();
            const subtotal = $(tr).find("td").eq(4).text();

            doc.text(`Vehículo ${index + 1}: ${placa}, ${vehiculo}, Precio: ${precio}, Subtotal: ${subtotal}`, 20, startY);
            startY += 10;
        });

        doc.text(`Subtotal: ${$("#subtotal").text()}`, 20, startY + 10);
        doc.text(`ISV (15%): ${$("#isv15").text()}`, 20, startY + 20);
        doc.text(`Descuento: ${$("#descuento").text()}`, 20, startY + 30);
        doc.text(`Total a Pagar: ${$("#totalPagar").text()}`, 20, startY + 40);

        doc.save("Factura.pdf");
    }

    $("#btnImprimirFactura").click(imprimirFactura);
});
</script>


