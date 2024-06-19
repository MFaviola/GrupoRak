<?php
// session_start();
require_once '../Services/VentaService.php';

$ventasService = new VentaService();

try {
    $vehiculos = $ventasService->listarVehiculos();

    $metodosPago = $ventasService->listarMetodosPago();

    if (!is_array($metodosPago)) {
        throw new Exception("No se pudo obtener una lista de métodos de pago.");
    }

    // if (!is_array($vehiculos)) {
    //     throw new Exception("No se pudo obtener una lista de vehículos.");
    // }

} catch (Exception $e) {
    $errorMsg = 'Error al cargar los métodos de pago o vehículos: ' . $e->getMessage();
    $metodosPago = [];
}

$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
$mensaje_tipo = isset($_SESSION['mensaje_tipo']) ? $_SESSION['mensaje_tipo'] : '';
unset($_SESSION['mensaje']);
unset($_SESSION['mensaje_tipo']);
?>

    <style>
        #detalleFactura thead th {
            background-color: #000; 
            color: #fff; 
        }

        .modal-lg {
            max-width: 90% !important; 
        }
    </style>

<div class="container mt-5">
    <h2 class="text-center">Facturación</h2>
    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-<?php echo $mensaje_tipo; ?>" role="alert">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    <form id="frmFactura" method="POST" action="facturacion_procesar.php">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Empleado</label>
                    <input type="text" class="form-control" id="empleado" name="empleado" value="1" readonly>
                </div>
                <div class="form-group">
                    <label>DNI del Cliente</label>
                    <input type="text" class="form-control" id="dniCliente" name="dniCliente" placeholder="Ingrese el DNI">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Fecha de creación</label>
                    <input type="date" class="form-control" id="fechaCreacion" name="fechaCreacion" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nombre del Cliente</label>
                    <input type="text" class="form-control" id="nombreCliente" placeholder="Seleccionar Cliente" readonly>
                    <input type="hidden" id="Cli_ID" name="Cli_ID">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Sede</label>
                    <input type="text" class="form-control" id="sede" name="sede" value="1" readonly>
                </div>
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
                    </select>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" id="btnAgregarProducto">Agregar Vehículo</button>
        <hr>
        <table id="detalleFactura" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Placa</th>
                    <th>Vehículo</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div class="text-right">
            <p><strong>Subtotal:</strong> <span id="subtotal">L 0.00</span></p>
            <p><strong>ISV (15%):</strong> <span id="isv15">L 0.00</span></p>
            <p><strong>Descuento:</strong> <span id="descuento">L 0.00</span></p>
            <p><strong>Total a Pagar:</strong> <span id="totalPagar">L 0.00</span></p>
        </div>
        <button type="submit" class="btn btn-success">Crear Factura</button>
    </form>
</div>

<!-- Modal para Buscar Vehículos -->
<div class="modal fade" id="modalVehiculos" tabindex="-1" role="dialog" aria-labelledby="modalVehiculosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> 
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVehiculosLabel">Lista de Vehículos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tablaVehiculos" class="table table-bordered table-striped">
                    <thead>
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

                            <td><button class="btn btn-success btn-sm seleccionar-vehiculo" data-placa="<?php echo $vehiculo['Veh_Placa']; ?>" data-modelo="<?php echo $vehiculo['Modelo']; ?>" data-color="<?php echo $vehiculo['Veh_Color']; ?>"data-color="<?php echo $vehiculo['Precio']; ?>">Agregar</button></td>


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

<!-- jQuery -->
<script src="../Views/Resources/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $("#btnAgregarProducto").click(function() {
        $("#modalVehiculos").modal('show');
    });

    $(".seleccionar-vehiculo").click(function() {
        var vehiculo = {
            placa: $(this).data('placa'),
            modelo: $(this).data('modelo'),
            color: $(this).data('color'),
            precio: $(this).data('precio'),
        };

        // Crear una nueva fila en la tabla de detalles
        var newRow = `
            <tr>
                <td>${$("#detalleFactura tbody tr").length + 1}</td>
                <td>${vehiculo.placa}</td>
                <td>${vehiculo.modelo} (${vehiculo.color})</td>
                <td>${vehiculo.precio}</td>
                <td><input type="number" class="form-control cantidad" value="1" min="1" data-precio="${vehiculo.precio}"></td>
                <td class="subtotal">${vehiculo.precio}</td>
                <td><button class="btn btn-danger btn-sm eliminar-vehiculo">Eliminar</button></td>
            </tr>
        `;

        // Añadir la nueva fila a la tabla de detalles
        $("#detalleFactura tbody").append(newRow);
        actualizarTotales();
        $("#modalVehiculos").modal('hide');
    });

    // Actualizar subtotal y total al cambiar la cantidad
    $(document).on('input', '.cantidad', function() {
        let cantidad = $(this).val();
        let precio = $(this).data('precio');
        let subtotal = cantidad * precio;
        $(this).closest('tr').find('.subtotal').text(subtotal.toFixed(2));
        actualizarTotales();
    });

    // Eliminar vehículo de la tabla de detalles
    $(document).on('click', '.eliminar-vehiculo', function() {
        $(this).closest('tr').remove();
        actualizarTotales();
    });

    // Función para actualizar los totales
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
});
</script>
