<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//header('Content-Type: application/json');
$root = $_SERVER['DOCUMENT_ROOT'] . '/GrupoRak/';

require_once $root . 'Services/ApartadoService.php';
require_once $root . 'Services/ClienteService.php';
require_once $root . 'Services/VentaService.php';

$controllerCompra = new ApartadoVehiculoService();
$controllerCliente = new ClienteService();
$ventasService = new VentaService();
$controllerapartado = new ApartadoVehiculoService();

//$response = array("status" => "error", "message" => "Ocurrió un error");

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $response = array("status" => "error", "message" => "Ocurrió un error");

        if (isset($_POST['action']) && $_POST['action'] == 'buscarCliente') {
            $dni = $_POST['dni'];
            try {
                $cliente = $controllerapartado->buscarClientePorDNI($dni);
                if ($cliente) {
                    $response = array("status" => "success", "data" => $cliente);
                } else {
                    $response = array("status" => "error", "message" => "Cliente no encontrado");
                }
            } catch (Exception $e) {
                $response = array("status" => "error", "message" => $e->getMessage());
            }
        } elseif (isset($_POST['formulario']) && !empty($_POST['formulario']) && $_POST['formulario'] == 'insertarEncabezado') {
            $fecha = $_POST['txtFecha'];
            $MetodoPago = $_POST['pagosSelect'];
            $Monto = $_POST['txtMonto'];
            $Caducacion = $_POST['txtFechaCaducacion'];
            $IdentidadBusqueda = $_POST['txtIdentidadBusqueda'];
            $ClienteBusqueda = $_POST['txtClienteBusqueda'];
            //$Veh_Placa = (!empty($_POST['txtVehPlaca']));
            $Cantidad = 1; // Suponiendo que siempre es 1, ajustar si es necesario
            //$PrecioCompra = (!empty($_POST['txtPrecioVehiculo'])); // Asegúrate de obtener este valor correctamente
            // $Imp_ID = $_POST['txtImpID']; // Asegúrate de obtener este valor correctamente
            
            if(!empty($Veh_Placa))
            {
                $Veh_Placa_A->$_POST['txtVehPlaca'] = $Veh_Placa;
            }

            if(!empty($PrecioCompra))
            {
                $PrecioCompra_A->$_POST['txtPrecioVehiculo'] = $PrecioCompra;
            }
            
            try {
                session_start();
                $Creacion = $_SESSION['ID'];
                $resultadoEncabezado = $controllerCompra->insertarEncabezado($fecha, $Veh_Placa_A, $PrecioCompra_A, $MetodoPago, $ClienteBusqueda, $Monto, $Caducacion, $Creacion, $Cantidad, $Creacion);
                $response = array("status" => "success", "message" => "Encabezado insertado correctamente");
            } catch (Exception $e) {
                $response['message'] = $e->getMessage();
            }
            echo json_encode($response);
            exit;
        } elseif (isset($_POST['formulario']) && $_POST['formulario'] == 'insertarCliente') {
            $nombre = $_POST['txtNombre'];
            $apellido = $_POST['txtApellido'];
            $FechaNacimiento = $_POST['txtFechaNacimiento'];
            $Sexo = $_POST['rbSexo'];
            $Identidad = $_POST['txtIdentidad'];
            $Ciudad = $_POST['ciudadSelect'];
            $Esciv = $_POST['estadoCivilSelect'];
            $Direccion = $_POST['txtDireccion'];

            try {
                session_start();
                $Creacion = $_SESSION['ID'];
                $clienteID = $controllerCliente->insertar($nombre, $apellido, $FechaNacimiento, $Sexo, $Identidad, $Ciudad, $Esciv, $Direccion, $Creacion);
                $response = array("status" => "success", "message" => "Cliente insertado correctamente", "clienteID" => $clienteID);
            } catch (Exception $e) {
                $response = array("status" => "error", "message" => $e->getMessage());
            }
            echo json_encode($response);
            exit;
        } elseif (isset($_POST['formulario']) && $_POST['formulario'] == 'insertarVehiculo') {
            $Placa = $_POST['txtPlaca'];
            $Color = $_POST['txtColor'];
            $PrecioVehiculo = $_POST['txtPrecioVehiculo'];
            $ModeloVehiculo = $_POST['modeloSelect'];
            $Imagen = $_POST['txtImagen']; // Solo el nombre del archivo

            try {
                session_start();
                $Creacion = $_SESSION['ID'];
                $resultadoVehiculo = $controllerCompra->insertarVehiculo($Placa, $Color, $Imagen, $PrecioVehiculo, $ModeloVehiculo, $Creacion);
                $response = array("status" => "success", "message" => "Vehículo insertado correctamente");
            } catch (Exception $e) {
                $response['message'] = $e->getMessage();
            }
            echo json_encode($response);
            exit;
        } elseif (isset($_POST['formulario']) && $_POST['formulario'] == 'buscarClientePorDNI') {
            $dni = $_POST['txtIdentidadBusqueda'];
            try {
                $cliente = $controllerCompra->buscarClientePorDNI($dni);
                $response = array("status" => "success", "cliente" => $cliente);
            } catch (Exception $e) {
                $response = array("status" => "error", "message" => $e->getMessage());
            }
        } else {
            $response = array("status" => "error", "message" => "Acción no válida");
        }
        // Agregar un log para depuración
        error_log("Response: " . json_encode($response));

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    exit;
}

try {
    $compras = $controllerCompra->listar();
    $pagos = $controllerCompra->listarMetodosPagos();
    $modelos = $controllerCompra->ModelosDDl(0);
    $marcas = $controllerCompra->listarMarcas();
    $estadosCiviles = $controllerCliente->listarEstadosCiviles();
    $ciudades = $controllerCliente->CiudadesDDl(0);
    $departamentos = $controllerCliente->listarDepartamentos();
    $vehiculos = $ventasService->listarVehiculos();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<div id="tabla">
    <div class="card">
        <div class="card-body">
            <h2 class="text-center" style="font-size:34px !important">Apartados de Vehiculos</h2>

            <button class="btn btn-primary" id="btnNuevo">
                <i class="fa-solid fa-plus"></i>
                Nuevo
            </button>
            <hr>
            <table id="example1" class="table  table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Fecha</th>
                        <th>Moto</th>
                        <th>Fecha de Caducacion</th>
                        <th>Metodo de Pago</th>
                        <th>Cliente</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($compras as $compra) : ?>
                        <tr>
                            <td><?php echo $compra['Apa_Id']; ?></td>
                            <td><?php echo $compra['Apa_Fecha']; ?></td>
                            <td><?php echo $compra['Apa_Monto']; ?></td>
                            <td><?php echo $compra['Apa_Fecha_Caducacion']; ?></td>
                            <td><?php echo $compra['Mpg_Descripcion']; ?></td>
                            <td><?php echo $compra['Cli_Nombre']; ?></td>
                            <td class="d-flex justify-content-center" style="gap:10px">


                                <button class="btn btn-secondary btn-sm btn-detalles" data-id="<?php echo $compra['Apa_Id']; ?>"><i class="fas fa-eye"></i>Detalles</button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-eraser"></i> Eliminar</button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="nuevaApartadoForm" style="display: block;">
    <div id="insertarEncabezado" style="display: none;">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title" id="form-title">Nuevo Apartado de Vehiculo</h3>
            </div>
            <div class="card-body">
                <form id="frmInsertarEncabezado" method="POST">
                    <input type="hidden" name="formulario" value="insertarEncabezado">

                    <div class="col-md-3" hidden>
                        <div class="form-group">
                            <label>Fecha de Compra: </label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="txtFecha" id="txtFecha" hide>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Identidad:</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="txtIdentidadBusqueda" name="txtIdentidadBusqueda">
                                    <div class="input-group-prepend">
                                        <button id="btnBuscarCliente" type="button" class="btn btn-primary"> <i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                                    </div>
                                </div>
                                <span style="color:red" class="error-message" id="errorIdentidadBusqueda"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cliente:</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="txtClienteBusqueda" name="txtClienteBusqueda" readonly>
                                    <div class="input-group-prepend">
                                        <button id="btnAgregarCliente" type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i> Agregar</button>
                                    </div>
                                </div>
                                <span style="color:red" class="error-message" id="errorClienteBusqueda"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Monto: </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="txtMonto" id="txtMonto">
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fecha Limited: </label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="txtFechaCaducacion" id="txtFechaCaducacion">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Metodo de Pago</label>
                                <select class="form-control select2" style="width: 100%;" id="pagosSelect" name="pagosSelect">
                                    <option value="0">Seleccione</option>
                                    <?php foreach ($pagos as $pago) : ?>
                                        <option value="<?php echo $pago['Mpg_ID']; ?>"><?php echo $pago['Mpg_Descripcion']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span style="color:red" class="error-message" id="errorMetodoPago"></span>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Descuento</label>
                                <select class="form-control" id="descuentoSelect" name="descuentoSelect" required>
                                    <option value="0">0%</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row">


                        <div class="card-body" style="margin-top: 10px;">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger" id="btnAgregarVehiculo"><i class="fa-solid fa-car"></i> Agregar Vehiculo</button>
                            </div>
                        </div>
                    </div>
                    <div class="card card-danger">
                        <div class="card-header">
                            <!-- <h3 class="card-title">Vehiculos Comprados</h3> -->
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table id="detalleFactura" class="table table-hover text-nowrap">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Id</th>
                                        <th>Placa</th>
                                        <th>Vehículo</th>
                                        <th>Precio</th>
                                        <th>Camtidad</th>
                                        <th>Subtotal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right">
                            <p><strong>Subtotal:</strong> <span id="subtotal">L 0.00</span></p>
                            <p><strong>ISV (15%):</strong> <span id="isv15">L 0.00</span></p>
                            <p><strong>Descuento:</strong> <span id="descuento">L 0.00</span></p>
                            <p><strong>Total a Pagar:</strong> <span id="totalPagar">L 0.00</span></p>
                        </div>
                    </div>


                    <div class="card-footer">
                        <div class="d-flex justify-content-end" style="gap:10px">
                            <button type="button" class="btn btn-primary" id="btnGuardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                            <button type="button" class="btn btn-primary" id="btnVehiculos"><i class="fa-solid fa-floppy-disk"></i> FDS</button>

                            <!-- <button type="button" class="btn btn-primary" id="btnFinalizar"><i class="fa-solid fa-check"></i> Finalizar</button> -->
                            <button type="button" id="Cancelar" class="btn btn-secondary"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>



    <!-- Formulario de Cliente -->
    <div id="insertar" style="display:none;">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title" id="form-title">Nuevo Cliente</h3>
            </div>
            <div class="card-body">
                <form id="frmInsertarCliente" method="POST">
                    <input type="hidden" name="formulario" value="insertarCliente">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Identidad:</label>
                                <input type="text" class="form-control" name="txtIdentidad" id="txtIdentidad" required>
                                <span style="color:red" class="error-message" id="errorIdentidad"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" name="txtNombre" id="txtNombre">
                                <span style="color:red" class="error-message" id="errorNombre"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Apellido:</label>
                                <input type="text" class="form-control" name="txtApellido" id="txtApellido">
                                <span style="color:red" class="error-message" id="errorApellido"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Sexo: </label>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input value="F" class="form-check-input" type="radio" name="rbSexo" id="rbfemenino" />
                                    <label class="form-check-label" for="rbfemenino">F</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input value="M" class="form-check-input" type="radio" name="rbSexo" id="rbmasculino" />
                                    <label class="form-check-label" for="rbmasculino">M</label>
                                </div>
                            </div>

                            <span style="color:red" class="error-message" id="errorSexo"></span>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fecha Nacimiento: </label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="txtFechaNacimiento" id="txtFechaNacimiento">
                                </div>
                                <span style="color:red" class="error-message" id="errorFecha"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Estado Civil</label>
                                <select class="form-control select2" style="width: 100%;" id="estadoCivilSelect" name="estadoCivilSelect">
                                    <option value="0">Seleccione</option>
                                    <?php foreach ($estadosCiviles as $estadoCivil) : ?>
                                        <option value="<?php echo $estadoCivil['Est_ID']; ?>"><?php echo $estadoCivil['Est_Descripcion']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span style="color:red" class="error-message" id="errorEsciv"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Departamento</label>
                                <select class="form-control select2" style="width: 100%;" id="departamentoSelect" name="departamentoSelect">
                                    <option value="0">Seleccione</option>
                                    <?php foreach ($departamentos as $departamento) : ?>
                                        <option value="<?php echo $departamento['Dep_ID']; ?>"><?php echo $departamento['Dep_Descripcion']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ciudad</label>
                                <select class="form-control select2" style="width: 100%;" id="ciudadSelect" name="ciudadSelect">
                                    <option value="0">Seleccione</option>
                                </select>
                                <span style="color:red" class="error-message" id="errorCiudad"></span>
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Direccion Exacta: </label>
                                <div class="input-group">
                                    <input type="text" class="form-control " name="txtDireccion" id="txtDireccion">
                                </div>
                                <span style="color:red" class="error-message" id="errorDireccion"></span>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end" style="gap:10px">
                            <button type="button" class="btn btn-primary" id="btnGuardarCliente"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                            <button type="button" id="btnVolverCliente" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Volver</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalVehiculos" tabindex="-1" role="dialog" aria-labelledby="modalVehiculosLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalVehiculosLabel">Lista de Vehículos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="card">
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

                                        <td><button class="btn btn-success btn-sm seleccionar-vehiculo" data-placa="<?php echo $vehiculo['Veh_Placa']; ?>" data-modelo="<?php echo $vehiculo['Modelo']; ?>" data-color="<?php echo $vehiculo['Veh_Color']; ?>" data-precio="<?php echo $vehiculo['Precio']; ?>">Agregar</button></td>


                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="timeoutModal" tabindex="-1" role="dialog" aria-labelledby="timeoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="timeoutModalLabel">Tiempo de espera agotado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    El tiempo de espera se ha agotado para generar la factura de apartado.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="acceptButton">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->

<script src="../Views/Resources/plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    // Función para limpiar errores
    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(function(error) {
            error.textContent = '';
        });
        document.querySelectorAll('.form-control').forEach(function(input) {
            input.classList.remove('is-invalid');
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Obtener la fecha actual
        var today = new Date();

        // Sumar 15 días a la fecha actual
        var expirationDate = new Date(today);
        expirationDate.setDate(expirationDate.getDate() + 15);

        // Formatear la fecha en formato yyyy-mm-dd
        var day = ("0" + expirationDate.getDate()).slice(-2);
        var month = ("0" + (expirationDate.getMonth() + 1)).slice(-2);
        var year = expirationDate.getFullYear();

        var formattedDate = year + "-" + month + "-" + day;

        // Establecer el valor del campo de fecha
        document.getElementById("txtFechaCaducacion").value = formattedDate;
    });

    $(document).ready(function() {
        $("#EsquemaVentas").addClass('menu-open');
        $("#LinkVentas").addClass('active');
        $("#apartado").addClass('active');
        var clienteactivo = $("#cliente").text();
        console.log('ES CLIENTE?' + clienteactivo)

        $("#btnAgregarVehiculo").click(function() {
            $("#modalVehiculos").modal('show');
        });
        $("#btnVehiculos").click(function() {
            var array = localStorage.getItem('myArray');
            // Se parsea para poder ser usado en js con JSON.parse :)
            array = JSON.parse(array);
            console.log(array)
        });


        $(".seleccionar-vehiculo").click(function() {
            var vehiculo = {
                placa: $(this).data('placa'),
                modelo: $(this).data('modelo'),
                color: $(this).data('color'),
                precio: $(this).data('precio'),
            };
            localStorage.setItem('vehiculosInsertados', JSON.stringify(vehiculo));
            console.log('DATOS VEHICULOS ' + vehiculo.placa)
            console.log('DATOS VEHICULOS ' + vehiculo.modelo)

            console.log('DATOS VEHICULOS ' + vehiculo.precio)

            console.log('DATOS VEHICULOS ' + vehiculo.color);

            var vehiculos = localStorage.getItem('vehiculosInsertados'); // Obtener de local storage


            // Crear una nueva fila en la tabla de detalles
            var newRow = `
            <tr>
                <td>${$("#detalleFactura tbody tr").length + 1}</td>
                <td name="txtVehPlaca">${vehiculo.placa}</td>
                <td>${vehiculo.modelo} (${vehiculo.color})</td>
                <td name="txtPrecioVehiculo">${vehiculo.precio}</td>
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

        $("#EsquemaVentas").addClass('menu-open');
        $("#LinkVentas").addClass('active');
        $("#LinkComprasVehiculos").addClass('active');

        // Al cargar la página, establecer la fecha actual en el campo de fecha de compra
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0!
        var yyyy = today.getFullYear();

        var fechaActual = yyyy + '-' + mm + '-' + dd;
        $('#txtFecha').val(fechaActual);

        // Función para cargar ciudades basadas en el departamento seleccionado
        $("#insertarEncabezado").hide();
        $("#detalleCompra").hide();

        $("#btnAgregarCliente").click(function() {
            $("#insertar").show();
            $("#insertarEncabezado").hide();
            $("#tabla").hide();
            clearErrors();
        });

        $("#btnVolverCliente").click(function() {
            $("#insertarEncabezado").show();
            $("#insertar").hide();
            $("#tabla").hide();
            clearErrors();
        });

        // Función para cargar ciudades
        function cargarCiudades(departamentoId, ciudadId) {
            if (departamentoId != 0) {
                $.ajax({
                    url: '../Services/ciudades_obtener.php',
                    type: 'GET',
                    data: {
                        id: departamentoId
                    },
                    success: function(response) {
                        var ciudades = JSON.parse(response);
                        var $ciudadSelect = $('#ciudadSelect');

                        $ciudadSelect.empty();
                        $ciudadSelect.append('<option value="0">Seleccione</option>');

                        ciudades.forEach(function(ciudad) {
                            $ciudadSelect.append('<option value="' + ciudad.Ciu_ID + '">' + ciudad.Ciu_Descripcion + '</option>');
                        });

                        // Seleccionar la ciudad si se proporciona un ID de ciudad
                        if (ciudadId) {
                            $ciudadSelect.val(ciudadId);
                        }
                    },
                    error: function() {
                        alert('Error al cargar las ciudades');
                    }
                });
            } else {
                $('#ciudadSelect').empty().append('<option value="0">Seleccione</option>');
            }
        }

        function cargarModelos(marcaId, modeloId) {
            if (marcaId != 0) {
                $.ajax({
                    url: '../Services/marcas_obtener.php',
                    type: 'GET',
                    data: {
                        id: marcaId
                    },
                    success: function(response) {
                        var ciudades = JSON.parse(response);
                        var $ciudadSelect = $('#modeloSelect');

                        $ciudadSelect.empty();
                        $ciudadSelect.append('<option value="0">Seleccione</option>');

                        ciudades.forEach(function(ciudad) {
                            $ciudadSelect.append('<option value="' + ciudad.Mod_Id + '">' + ciudad.Mod_Descripcion + '</option>');
                        });

                        // Seleccionar la ciudad si se proporciona un ID de ciudad
                        if (modeloId) {
                            $ciudadSelect.val(modeloId);
                        }
                    },
                    error: function() {
                        alert('Error al cargar las ciudades');
                    }
                });
            } else {
                $('#modeloSelect').empty().append('<option value="0">Seleccione</option>');
            }
        }

        $('#departamentoSelect').change(function() {
            var departamentoId = $(this).val();
            console.log('ID DEPARTAMENTO' + departamentoId)
            cargarCiudades(departamentoId);
        });

        $('#marcaSelect').change(function() {
            var departamentoId = $(this).val();
            console.log('ID DEPARTAMENTO' + departamentoId)
            cargarModelos(departamentoId);
        });

        // Inicialización de DataTables
        var table = $("#example1").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
        });

        var table = $("#tablaVehiculos").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
        });

        $("#btnNuevo").click(function() {
            $("#form-title").text('Nueva Apartado de Vehiculo');
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
            $("#detalleCompra").show();
            $("#tabla").hide();
        });

        $("#Cancelar").click(function() {
            $("#insertar").hide();
            $("#tabla").show();
            $("#insertarEncabezado").hide();
            clearErrors();
        });

        // Enviar formularios
        $("#btnGuardar").click(function() {
            var formData = new FormData($("#frmInsertarEncabezado")[0]);
       

            var Precio = $("#txtPrecioVehiculo").text();
            // formData.append("txtPrecioVehiculo", Precio);
            console.log('PRECIO VEHICULO: ' + Precio) 

            $.ajax({
                type: "POST",
                url: "../Views/Pages/apartado.php", // Ajusta la ruta a tu archivo PHP
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response); // Imprimir la respuesta en la consola para depuración
                    try {
                        var resultado = JSON.parse(response);
                        if (resultado.status === "success") {
                            alert(resultado.message);
                            $("#frmInsertarEncabezado")[0].reset();
                        } else {
                            alert("Error: " + resultado.message);
                        }
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                        console.error("Response:", response);
                    }
                },
                error: function() {
                    alert("Error en la solicitud AJAX");
                }
            });
        });

        $("#btnGuardarCliente").click(function() {
            var formData = new FormData($("#frmInsertarCliente")[0]);



            $.ajax({
                type: "POST",
                url: "", // URL del script PHP
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response); // Imprimir la respuesta en la consola para depuración
                    try {
                        var resultado = JSON.parse(response);
                        if (resultado.status === "success") {
                            var clienteID = resultado.clienteID;
                            console.log("Cliente ID: " + clienteID);
                            // Puedes usar el clienteID para otras operaciones

                            alert(resultado.message);
                            $("#frmInsertarCliente")[0].reset();
                            $("#insertar").hide();
                            $("#tabla").hide();
                            $("#insertarEncabezado").show();
                        } else {
                            alert("Error: " + resultado.message);
                        }
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                        console.error("Response:", response);
                    }
                },
                error: function() {
                    alert("Error en la solicitud AJAX");
                }
            });

        });

        $("#btnBuscarCliente").click(function() {
            var dni = $("#txtIdentidadBusqueda").val();
            if (dni) {
                $.ajax({
                    type: "POST",
                    url: "../Views/Pages/apartado.php",
                    data: {
                        action: 'buscarCliente',
                        dni: dni
                    },
                    success: function(response) {
                        console.log(response); // Imprime la respuesta en la consola
                        try {
                            if (typeof response === "string") {
                                response = JSON.parse(response);
                            }
                            if (response.status === "success") {
                                $("#txtClienteBusqueda").val(response.data.Cli_Nombre);
                            } else {
                                $("#errorClienteBusqueda").text(response.message);
                            }
                        } catch (e) {
                            $("#errorClienteBusqueda").text("Respuesta no es un JSON válido.");
                        }
                    },
                    error: function() {
                        $("#errorClienteBusqueda").text("Error en la solicitud AJAX");
                    }
                });
            } else {
                $("#errorClienteBusqueda").text("Por favor, ingrese un número de identidad válido.");
            }
        });






        // $("#btnGuardarVehiculo").click(function() {

        //     const placa = $("#txtPlaca").val();
        //     const color = $("#txtColor").val();
        //     const precio = $("#txtPrecioVehiculo").val();
        //     const imagen = $("#txtImagen").val();
        //     const modelo = $("#modeloSelect").val();
        //     console.log('Placa: ' + placa);
        //     console.log('Color: ' + color);
        //     console.log('Precio: ' + precio);
        //     console.log('Imagen: ' + imagen);
        //     console.log('Modelo: ' + modelo);

        //     $("#frmInsertarVehiculo").submit(function(event) {
        //         event.preventDefault();
        //         console.log('Placa: ' + $("$txtPlaca").val());
        //     });
        // });

    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var timeout;
        var initialTimeoutDuration = 30000; // 5 minutos en milisegundos
        var shortTimeoutDuration = 6000; // 1 minuto en milisegundos
        var isInteracting = false;

        // Función para mostrar el modal
        function showTimeoutModal() {
            if (document.getElementById('nuevaApartadoForm').style.display === 'block') {
                $('#timeoutModal').modal('show');
            }
        }

        // Función para cerrar el formulario y mostrar la tabla
        function closeFormAndShowTable() {
            $('#timeoutModal').modal('hide');
            document.getElementById('nuevaApartadoForm').style.display = 'none';
            document.getElementById('tabla').style.display = 'block';
            clearTimeout(timeout); // Desactivar el temporizador
        }

        // Función para abrir el formulario "Nueva Apartado de Vehiculo"
        function openNuevaApartadoForm() {
            document.getElementById('nuevaApartadoForm').style.display = 'block';
            document.getElementById('tabla').style.display = 'none';
            resetTimer(initialTimeoutDuration); // Activar el temporizador con 5 minutos
        }

        // Función para restablecer el temporizador
        function resetTimer(duration) {
            clearTimeout(timeout);
            if (document.getElementById('nuevaApartadoForm').style.display === 'block') {
                timeout = setTimeout(function() {
                    if (!isInteracting && duration === initialTimeoutDuration) {
                        resetTimer(shortTimeoutDuration); // Cambiar a 1 minuto después de 5 minutos si no hay interacción
                    } else if (!isInteracting && duration === shortTimeoutDuration) {
                        showTimeoutModal(); // Mostrar modal después de 1 minuto sin interacción
                    } else {
                        isInteracting = false; // Resetear el flag de interacción
                        resetTimer(initialTimeoutDuration); // Volver a 5 minutos si hubo interacción
                    }
                }, duration);
            }
        }

        // Función para manejar la interacción del usuario
        function handleInteraction() {
            isInteracting = true;
            resetTimer(initialTimeoutDuration); // Restablecer a 5 minutos en caso de interacción
        }

        // Inicializar interacciones del formulario
        function setupFormInteractions() {
            const formElements = document.querySelectorAll('#nuevaApartadoForm input, #nuevaApartadoForm select, #nuevaApartadoForm textarea');
            formElements.forEach(function(element) {
                element.addEventListener('click', handleInteraction);
                element.addEventListener('mousemove', handleInteraction);
                element.addEventListener('keypress', handleInteraction);
                element.addEventListener('scroll', handleInteraction);
            });
        }

        // Inicializar interacciones del formulario
        setupFormInteractions();

        // Manejar el botón de aceptar en el modal
        document.getElementById('acceptButton').addEventListener('click', function() {
            closeFormAndShowTable();
        });

        // Manejar el botón de "Nuevo Apartado de Vehiculo"
        document.getElementById('btnNuevo').addEventListener('click', function() {
            openNuevaApartadoForm();
        });
    });
</script>