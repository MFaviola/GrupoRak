<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../Services/CompraVehiculoService.php';
require_once '../Services/ClienteService.php';

$controllerCompra = new CompraVehiculoService();
$controllerCliente = new ClienteService();

$response = array("status" => "error", "message" => "Ocurrió un error");

// Procesar la solicitud POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['formulario'])) {
        switch ($_POST['formulario']) {
            case 'insertarEncabezado':
                try {
                    $FechaCompra = date('Y-m-d'); // Obtener la fecha actual
                    $MetodoPago = $_POST['pagosSelect'];
                    $IdentidadBusqueda = $_POST['txtIdentidadBusqueda'];
                    $ClienteBusqueda = $_POST['txtClienteBusqueda'];


                    // Insertar el encabezado de la compra
                    $Creacion = $_SESSION['ID'];
                    if (!isset($_SESSION['clienteID'])) {
                        throw new Exception("Cliente ID no está disponible en la sesión");
                    }
                    $clienteID = $_SESSION['clienteID'];
                    $CompraId = $controllerCompra->insertarEncabezado($FechaCompra, $MetodoPago, $clienteID, $Creacion);
                    if ($CompraId != 0) {
                        $_SESSION['CompraId'] = $CompraId; // Almacenar ID de compra en sesión
                    }


                    $response = array(
                        "ID" => $CompraId,
                        "ID CLIENTE" => $clienteID,
                        "MetodoPAGO" => $MetodoPago,
                        "Fecha" => $FechaCompra,
                        "Usuario" => $Creacion
                    );
                } catch (Exception $e) {
                    $response['message'] = $e->getMessage();
                }
                break;

            case 'insertarDetalle':
                try {
                    // Obtener datos del detalle de compra
                    $PrecioCompra = $_SESSION['PrecioVehiculo'];
                    $CompraId = $_SESSION['CompraId'];
                    $PlacaDetalle = $_SESSION['Placa'];
                    $Impuesto = 1;

                    // Insertar el detalle de la compra
                    $Creacion = $_SESSION['ID'];
                    $resultadoDetalle = $controllerCompra->insertarDetalle($PrecioCompra, $CompraId, $PlacaDetalle, $Impuesto, $Creacion);
                    $response = array("Resultado Detalle" => $resultadoDetalle);
                } catch (Exception $e) {
                    $response['message'] = $e->getMessage();
                }
                break;

            case 'insertarCliente':
                try {
                    $nombre = $_POST['txtNombre'];
                    $apellido = $_POST['txtApellido'];
                    $FechaNacimiento = $_POST['txtFechaNacimiento'];
                    $Sexo = $_POST['rbSexo'];
                    $Identidad = $_POST['txtIdentidad'];
                    $Ciudad = $_POST['ciudadSelect'];
                    $Esciv = $_POST['estadoCivilSelect'];
                    $Direccion = $_POST['txtDireccion'];

                    $Creacion = $_SESSION['ID'];

                    $clienteID = $controllerCliente->insertar($nombre, $apellido, $FechaNacimiento, $Sexo, $Identidad, $Ciudad, $Esciv, $Direccion, $Creacion);

                    if ($clienteID != '') {
                        $_SESSION['clienteID'] = $clienteID; // Almacenar $clienteID en la sesión
                    }

                    $response = array("status" => "success", "message" => "Cliente insertado correctamente", "clienteID" => $clienteID);
                } catch (Exception $e) {
                    $response = array("status" => "error", "message" => $e->getMessage());
                }
                break;

            case 'insertarVehiculo':
                try {
                    $Placa = $_POST['txtPlaca'];
                    $Color = $_POST['txtColor'];
                    $PrecioVehiculo = $_POST['txtPrecioVehiculo'];
                    $ModeloVehiculo = $_POST['modeloSelect'];
                    $Imagen = $_FILES['txtImagen']; // Archivo subido

                    $Creacion = $_SESSION['ID'];

                    // Ruta de destino para guardar la imagen
                    $carpetaDestino = '../Resources/uploads/';
                    if (!file_exists($carpetaDestino)) {
                        mkdir($carpetaDestino, 0777, true);
                    }

                    // Nombre del archivo de imagen
                    $nombreArchivo = basename($Imagen['name']);
                    $rutaArchivo = $carpetaDestino . $nombreArchivo;

                    // Mover el archivo subido a la carpeta destino
                    if (move_uploaded_file($Imagen['tmp_name'], $rutaArchivo)) {
                        $resultadoVehiculo = $controllerCompra->insertarVehiculo($Placa, $Color, $nombreArchivo, $PrecioVehiculo, $ModeloVehiculo, $Creacion);
                        if ($resultadoVehiculo == 1) {
                            $_SESSION['Placa'] = $Placa; // Almacenar $clienteID en la sesión
                            $_SESSION['PrecioVehiculo'] = $PrecioVehiculo; // Almacenar $clienteID en la sesión
                        }
                        $response = array("Resultado" => $resultadoVehiculo);
                    } else {
                        throw new Exception("Error al mover la imagen subida");
                    }
                } catch (Exception $e) {
                    $response = array("status" => "error", "message" => $e->getMessage());
                }
                break;

            default:
                $response['message'] = "Formulario no reconocido";
                break;
        }
    } else {
        $response['message'] = "Formulario no especificado";
    }

    // Enviar la respuesta como JSON
    echo json_encode($response);
    exit;
}

// Código para cargar datos adicionales en el contexto de la página (listar, etc.)
try {
    $compras = $controllerCompra->listar();
    $pagos = $controllerCompra->listarMetodosPagos();
    $modelos = $controllerCompra->ModelosDDl(0);
    $marcas = $controllerCompra->listarMarcas();
    $estadosCiviles = $controllerCliente->listarEstadosCiviles();
    $ciudades = $controllerCliente->CiudadesDDl(0);
    $departamentos = $controllerCliente->listarDepartamentos();
    $listarDetalles = $controllerCompra->ListarComprasDetalles(0);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>




<div id="tabla">
    <div class="card">
        <div class="card-body">
            <h2 class="text-center" style="font-size:34px !important">Compras</h2>

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
                        <th>Metodo de Pago</th>
                        <th>Cliente</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($compras as $compra) : ?>
                        <tr>
                            <td><?php echo $compra['Com_Id']; ?></td>
                            <td><?php echo $compra['Com_Fecha']; ?></td>
                            <td><?php echo $compra['Mpg_Descripcion']; ?></td>
                            <td><?php echo $compra['Cli_Nombre']; ?></td>
                            <td class="d-flex justify-content-center" style="gap:10px">

                                <button style="color:white" class="btn btn-dark btn-sm abrir-editar" data-id="<?php echo $compra['Com_Id']; ?>"><i class="fas fa-edit"></i>Editar</button>
                                <button class="btn btn-secondary btn-sm btn-detalles" data-id="<?php echo $compra['Com_Id']; ?>"><i class="fas fa-eye"></i>Detalles</button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-eraser"></i> Eliminar</button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="insertarEncabezado" style="display: none;">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title" id="form-title">Nueva Compra</h3>
        </div>
        <div class="card-body">
            <form id="frmInsertarEncabezado" method="POST">
                <input type="hidden" name="formulario" value="insertarEncabezado">
                <input type="hidden" id="CompraId" name="CompraId" value="<?php echo isset($_SESSION['CompraId']) ? htmlspecialchars($_SESSION['CompraId']) : ''; ?>">

                <div class="row">

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
                    <div class="col-md-6 d-flex align-items-center justify-content-end">
                        <!-- Aquí se coloca la imagen pequeña al final -->
                        <img src="../Views\Resources\dist\img\logroRac.jpg" style="max-height: 100px; margin-left: 10px;" alt="Imagen pequeña">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Identidad:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="txtIdentidadBusqueda" name="txtIdentidadBusqueda">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"> <i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                                </div>
                                <!-- /btn-group -->

                            </div>
                            <span style="color:red" class="error-message" id="errorIdentidadBusqueda"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cliente:</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="txtClienteBusqueda" name="txtClienteBusqueda" disabled>
                                <div class="input-group-prepend">
                                    <button id="btnAgregarCliente" type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i> Agregar</button>
                                </div>
                                <!-- /btn-group -->

                            </div>
                            <span style="color:red" class="error-message" id="errorClienteBusqueda"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger" id="btnAgregarVehiculo"><i class="fa-solid fa-car"></i> Agregar Vehiculo</button>
                        </div>
                    </div>
                </div>
                <div id="detalleCompra" class="row">
                    <div class="col-12">
                        <div class="card card-danger">
                            <div class="card-header">
                                <!-- <h3 class="card-title">Vehiculos Comprados</h3> -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">Placa</th>
                                            <th class="text-center">Color</th>
                                            <th class="text-center">Modelo</th>
                                            <th class="text-center">Año</th>
                                            <th class="text-center">Marca</th>
                                            <th class="text-center">Precio Compra</th>
                                            <th class="text-center">Impuesto</th>
                                            <th class="text-center">Acciones</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listarDetalles as $detalle) : ?>
                                            <tr>
                                                <td class="text-center"><?php echo $detalle['Veh_Placa']; ?></td>
                                                <td class="text-center"><?php echo $detalle['Veh_Color']; ?></td>
                                                <td class="text-center"><?php echo $detalle['Mod_Descripcion']; ?></td>
                                                <td class="text-center"><?php echo $detalle['Mod_Año']; ?></td>
                                                <td class="text-center"><?php echo $detalle['Mar_Descripcion']; ?></td>
                                                <td class="d-flex justify-content-center">
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="precioCompra[]" value="<?php echo $detalle['Cdt_PrecioCompra']; ?>">
                                                    </div>

                                                </td>
                                                <td><?php echo $detalle['Imp_ISV']; ?></td>
                                                <td><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>


                <div class="card-footer">
                    <div class="d-flex justify-content-end" style="gap:10px">
                        <button type="button" class="btn btn-primary" id="btnFinalizar" disabled><i class="fa-solid fa-check"></i> Finalizar</button>
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
                <input type="hidden" id="clienteID" name="clienteID" value="<?php echo isset($_SESSION['clienteID']) ? htmlspecialchars($_SESSION['clienteID']) : ''; ?>">


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


<!-- Formulario de Vehiculo -->
<div id="insertarVehiculo" style="display:none;">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title" id="form-title">Nuevo Vehiculo</h3>
        </div>
        <div class="card-body">
            <form id="frmInsertarVehiculo" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="formulario" value="insertarVehiculo">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Placa:</label>
                            <input type="text" class="form-control" name="txtPlaca" id="txtPlaca">
                            <span style="color:red" class="error-message" id="errorPlaca"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Color:</label>
                            <input type="text" class="form-control" name="txtColor" id="txtColor">
                            <span style="color:red" class="error-message" id="errorColor"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Precio:</label>
                            <input type="text" class="form-control" name="txtPrecioVehiculo" id="txtPrecioVehiculo">
                            <span style="color:red" class="error-message" id="errorPrecio"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="txtImagen" id="txtImagen">
                            <span style="color:red" class="error-message" id="errorImagen"></span>
                        </div>

                        <label class="control-label">Imagen Actual</label>
                        <div id="imagenActualContainer">
                            <img id="imagenActual" src="#" alt="Imagen Actual" style="max-width: 100%;" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Marca</label>
                            <select class="form-control select2" style="width: 100%;" id="marcaSelect" name="marcaSelect">
                                <option value="0">Seleccione</option>
                                <?php foreach ($marcas as $marca) : ?>
                                    <option value="<?php echo $marca['Mar_Id']; ?>"><?php echo $marca['Mar_Descripcion']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Modelo</label>
                            <select class="form-control select2" style="width: 100%;" id="modeloSelect" name="modeloSelect">
                                <option value="0">Seleccione</option>
                            </select>
                            <span style="color:red" class="error-message" id="errorModelo"></span>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end" style="gap:10px">
                        <button type="button" class="btn btn-primary" id="btnGuardarVehiculo"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>

                        <button type="button" id="btnVolverVehiculo" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Volver</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- jQuery -->

<script src="../Views/Resources/plugins/jquery/jquery.min.js"></script>



<script>
    function cargarImagenActual(imagen) {
        var imagenActual = $('#imagenActual');
        if (imagen) {
            var imageUrl = '/GrupoRak/Resources/uploads/' + encodeURIComponent(imagen);
            imagenActual
                .attr('src', imageUrl)
                .attr('style', 'max-width: 100%; max-height: 200px;')
                .show();
        } else {
            imagenActual
                .attr('src', '#')
                .hide();
        }
    }
    // Función para limpiar errores
    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(function(error) {
            error.textContent = '';
        });
        document.querySelectorAll('.form-control').forEach(function(input) {
            input.classList.remove('is-invalid');
        });
    }
    $(document).ready(function() {
        var encabezadoInsertado = false; // Variable de control para evitar insertar el encabezado más de una vez

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



        $('#txtImagen').change(function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagenActual')
                        .attr('src', e.target.result)
                        .attr('style', 'max-width: 100%; max-height: 200px;')
                        .show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        });


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

        $("#btnAgregarVehiculo").click(function() {

            var cliente = $("#txtClienteBusqueda").val();
            var metodo = $("#pagosSelect").val();
            console.log(metodo);
            if (cliente != '' && metodo != '0') {
                $("#insertarVehiculo").show();
                $("#insertarEncabezado").hide();

                cargarImagenActual(null);
            }

        });


        $("#btnVolverVehiculo").click(function() {
            $("#insertarEncabezado").show();
            $("#insertarVehiculo").hide();
            $("#tabla").hide();

            clearErrors();
        });

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


        $("#Cancelar").click(function() {
            $("#insertar").hide();
            $("#tabla").show();
            $("#insertarEncabezado").hide();
            window.location.reload();
            clearErrors();
        });

        // Enviar formularios
        $("#btnGuardar").click(function() {
            // $("#frmInsertarEncabezado").submit();

            var formData = new FormData($("#frmInsertarEncabezado")[0]);
            $.ajax({
                type: "POST",
                url: "", // URL del script PHP
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {

                    console.log(response)

                    // $("#frmInsertarCliente")[0].reset();
                    // $("#insertar").hide();
                    // $("#tabla").hide();
                    // $("#insertarEncabezado").show();
                    // $("#txtIdentidadBusqueda").val(identidadBusqeda);
                    // $("#txtClienteBusqueda").val(clienteBusqueda);
                    // } catch (e) {
                    //     console.error("Error parsing JSON:", e);
                    //     console.error("Response:", response);
                    // }
                },
                error: function() {
                    alert("Error en la solicitud AJAX");
                }
            });
        });


        $("#btnGuardarCliente").click(function() {

            var formData = new FormData($("#frmInsertarCliente")[0]);
            var identidadBusqeda = $("#txtIdentidad").val();
            var clienteBusqueda = $("#txtNombre").val() + ' ' + $("#txtApellido").val();

            // Actualizar el valor de clienteID desde el input hidden
            var clienteID = $("#clienteID").val();
            console.log('CO' + clienteID)
            $.ajax({
                type: "POST",
                url: "", // URL del script PHP
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log("ID CLIENTE CREADO: " + clienteID);
                    $("#frmInsertarCliente")[0].reset();
                    $("#insertar").hide();
                    $("#tabla").hide();
                    $("#insertarEncabezado").show();
                    $("#txtIdentidadBusqueda").val(identidadBusqeda);
                    $("#txtClienteBusqueda").val(clienteBusqueda);
                },
                error: function() {
                    alert("Error en la solicitud AJAX");
                }
            });



        });



        function insertarEncabezado() {



            var compraID = $("#CompraId").val();
            var compraIDSumado = parseInt(compraID) + 1; // Sumar 1 al valor de CompraId

            if (!encabezadoInsertado) {
                var pagosSelect = $("#pagosSelect").val();
                var txtIdentidadBusqueda = $("#txtIdentidadBusqueda").val();
                var txtClienteBusqueda = $("#txtClienteBusqueda").val();

                console.log('COMPRA ID: ' + compraIDSumado);

                $.ajax({
                    type: "POST",
                    url: "", // URL del script PHP
                    data: {
                        formulario: 'insertarEncabezado',
                        pagosSelect: pagosSelect,
                        txtIdentidadBusqueda: txtIdentidadBusqueda,
                        txtClienteBusqueda: txtClienteBusqueda
                    },
                    success: function(response) {

                        console.log("Encabezado insertado correctamente", compraIDSumado);

                        encabezadoInsertado = true;
                        insertarDetalle(compraIDSumado); // Pasar el ID de la compra al insertar el detalle

                    },
                    error: function() {
                        alert("Error al insertar el encabezado");
                    }
                });
            } else {

                insertarDetalle(compraIDSumado);
            }
        }

        function insertarDetalle(compraId) {
            $.ajax({
                type: "POST",
                url: "", // URL del script PHP
                data: {
                    formulario: 'insertarDetalle'
                },
                success: function(response) {

                    cargarDetallesCompra(compraId); // Cargar los detalles de la compra después de insertar el detalle
                },
                error: function() {
                    alert("Error al insertar el detalle");
                }
            });
        }

        function cargarDetallesCompra(compraId) {

            $.ajax({
                type: "GET",
                url: "comprasDetalles_obtener.php",
                data: {
                    id: compraId
                },
                success: function(response) {
                    var detalles = JSON.parse(response);
                    console.log("DETALLES :" + detalles);
                    var tbody = $("#detalleCompra tbody");
                    tbody.empty(); // Limpiar tabla

                    detalles.forEach(function(detalle) {
                        var fila = `<tr>
                    <td>${detalle.Veh_Placa}</td>
                    <td>${detalle.Veh_Color}</td>
                    <td>${detalle.Mod_Descripcion}</td>
                    <td>${detalle.Mod_Año}</td>
                    <td>${detalle.Mar_Descripcion}</td>
                    <td><input type="text" class="form-control" name="precioCompra[]" value="${detalle.Cdt_PrecioCompra}"></td>
                    <td>${detalle.Imp_ISV}</td>
                    <td><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></td>
                </tr>`;
                        tbody.append(fila);
                    });
                    $("#detalleCompra").show();
                },
                error: function() {
                    alert("Error al cargar los detalles de la compra");
                }
            });
        }


        // Enviar formulario de vehiculo y luego insertar encabezado y detalle
        $("#btnGuardarVehiculo").click(function() {
            var formData = new FormData($("#frmInsertarVehiculo")[0]);

            // Extraer el nombre del archivo
            var fileName = $("#txtImagen").val().split('\\').pop();
            formData.append("txtImagen", fileName);
            var Precio = $("#txtPrecioVehiculo").val();
            formData.append("txtPrecioVehiculo", Precio);

            $.ajax({
                type: "POST",
                url: "", // URL del script PHP
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    $("#frmInsertarVehiculo")[0].reset();
                    $("#insertarVehiculo").hide();
                    $("#insertarEncabezado").show();
                    // Deshabilitar el campo #txtIdentidadBusqueda
                    $("#txtIdentidadBusqueda").prop('disabled', true);
                    $("#btnFinalizar").prop('disabled',false);
                    // Insertar el encabezado después de insertar el vehículo
                    insertarEncabezado();


                },
                error: function() {
                    alert("Error en la solicitud AJAX");
                }
            });
        });



    });
</script>