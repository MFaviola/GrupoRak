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
                    $id = isset($_POST['id']) ? $_POST['id'] : null;
                    $FechaCompra = date('Y-m-d'); // Obtener la fecha actual
                    $MetodoPago = $_POST['pagosSelect'];
                    $IdentidadBusqueda = $_POST['txtIdentidadBusqueda'];
                    $ClienteBusqueda = $_POST['txtClienteBusqueda'];
                    $EsBusqueda = $_POST['IdCliente'];
                    $clienteID = $_SESSION['clienteID'];
                    $clienteIDUsado = !empty($EsBusqueda) ? $EsBusqueda : $clienteID;
                    $Creacion = $_SESSION['ID'];

                    if ($id) {
                        // Editar encabezado existente
                        $resultado = $controllerCompra->actualizarEncabezado($id, $FechaCompra, $MetodoPago, $clienteIDUsado, $Creacion);
                        $response = array(
                            "status" => "success",
                            "message" => "Encabezado editado correctamente",
                            "ID" => $id,
                            "ID CLIENTE" => $clienteID,
                            "MetodoPAGO" => $MetodoPago,
                            "Fecha" => $FechaCompra,
                            "Usuario" => $Creacion
                        );
                    } else {
                        $CompraId = $controllerCompra->insertarEncabezado($FechaCompra, $MetodoPago, $clienteIDUsado, $Creacion);
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
                    }
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>


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
                                <?php if ($compra['Com_Estado'] == 1) : ?>
                                    <button style="color:white" class="btn btn-dark btn-sm abrir-editar" data-id="<?php echo $compra['Com_Id']; ?>">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                <?php endif; ?>
                                <button class="btn btn-secondary btn-sm btn-detalles" data-id="<?php echo $compra['Com_Id']; ?>">
                                    <i class="fas fa-eye"></i> Detalles
                                </button>
                                <?php if ($compra['Com_Estado'] == 1) : ?>
                                    <button class="btn btn-danger btn-sm btnFinalizarIndex" data-id="<?php echo $compra['Com_Id']; ?>">
                                        <i class="fa-solid fa-check"></i> Finalizar
                                    </button>
                                <?php endif; ?>
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
                <input type="hidden" name="id" id="id">
                <input type="hidden" id="CompraId" name="CompraId" value="<?php echo isset($_SESSION['CompraId']) ? htmlspecialchars($_SESSION['CompraId']) : ''; ?>">
                <input type="hidden" class="form-control" id="IdCliente" name="IdCliente">
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
                                <input type="text" class="form-control" id="txtIdentidadBusqueda" name="txtIdentidadBusqueda" maxlength="13">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                </div>
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

                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm btnEliminarDetalle" data-id="<?php echo $detalle['id']; ?>"><i class="fa-solid fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="card-body">
                                    <div class="text-right">
                                        <p><strong>Subtotal:</strong> <span id="subtotal">L 0.00</span></p>
                                        <p><strong>ISV (15%):</strong> <span id="isv15">L 0.00</span></p>
                                        <p><strong>Total a Pagar:</strong> <span id="totalPagar">L 0.00</span></p>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>


                <div class="card-footer">
                    <div class="d-flex justify-content-end" style="gap:10px">
                        <button type="button" class="btn btn-primary btnFinalizarCreate" disabled><i class="fa-solid fa-check"></i> Finalizar</button>
                        <button type="button" onclick="generateReport()" class="btn btn-info"><i class="fa-solid fa-check"></i> Imprimir</button>
                        <button type="button" id="Cancelar" class="btn btn-secondary"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="container mt-3 pdfContenedor">
    <div class="collapse" id="pdfPreview">
        <div class="card card-body">
            <div class="d-flex justify-content-end" style="gap:10px">
                <button class="btn btn-primary btnVolverImpresion"><i class="fa-solid fa-arrow-left"></i> Volver</button>
            </div>
            <div class="mt-2">

            </div>
            <embed id="pdfEmbed" src="" type="application/pdf" width="100%" height="600px" />
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
                            <input type="text" class="form-control" name="txtIdentidad" id="txtIdentidad" required maxlength="13">
                            <span style="color:red" class="error-message" id="errorIdentidad"></span>
                            <span style="color:red" class="error-message" id="errorIdentidadLongitud"></span>

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
                            <input type="text" class="form-control" name="txtPlaca" id="txtPlaca" maxlength="7">
                            <span style="color:red" class="error-message" id="errorPlaca"></span>
                            <span style="color:red" class="error-message" id="errorPlacaLongitud"></span>

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
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center">
                            <img id="imagenActual" src="#" alt="Imagen Actual" style="max-width: 100%;" />
                        </div>
                    </div>

                </div>
                <br>
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

<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="modalEliminarDetalle" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarLabel">Confirmar Eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este registro?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnConfirmarEliminarDetalle"><i class="fa-solid fa-trash"></i> Eliminar</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmación de Finalizacion -->
<div class="modal fade" id="modalFinalizar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarLabel">Confirmar Finalización</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas finalizar esta compra?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnConfirmarFinalizar"><i class="fa-solid fa-check"></i> Finalizar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmación de Finalizacion Create -->
<div class="modal fade" id="modalFinalizarCreate" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarLabel">Confirmar Finalización</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas finalizar esta compra?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnConfirmarFinalizarCreate"><i class="fa-solid fa-check"></i> Finalizar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>

            </div>
        </div>
    </div>
</div>


<!-- Detalles -->
<div id="detalles" style="display:none;">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title" id="form-title">Detalle Compra</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Codigo:</strong> <span id="Detalle_Codigo"></span></p>
                    <p><strong>Fecha:</strong> <span id="Detalle_Fecha"></span></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Metodo de Pago:</strong> <span id="Detalle_Pago"></span></p>
                    <p><strong>Cliente DNI:</strong> <span id="Detalle_DNI"></span></p>

                </div>

            </div>
            <div class="mt-1 row">
                <div class="col-md-6">
                    <p><strong>Cliente:</strong> <span id="Detalle_Cliente"></span></p>
                </div>
            </div>
            <div id="detalleCompra2" class="row">
                <div class="col-12">
                    <div class="card">

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
                                        <th class="text-center">Precio</th>
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

                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm btnEliminarDetalle" data-id="<?php echo $detalle['id']; ?>"><i class="fa-solid fa-trash"></i></button>
                                            </td>
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
            <hr>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Acción</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Creado por</td>
                        <td id="Detalle_Creacion"></td>
                        <td id="Detalle_FechaCreacion"></td>
                    </tr>
                    <tr>
                        <td>Modificado por</td>
                        <td id="Detalle_Modifica"></td>
                        <td id="Detalle_FechaModifica"></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div class="d-flex justify-content-end">
                <button class="btn btn-secondary btn-sm" id="btnVolver"><i class="fa-solid fa-arrow-left"></i> Volver</button>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->

<script src="../Views/Resources/plugins/jquery/jquery.min.js"></script>



<script>
    async function generateReport() {
        let idcompra = 0;
        let id = $("#id").val();
        var compraIDSumado = localStorage.getItem('compraIDSumado'); // Obtener de local storage
        idcompra = compraIDSumado;

        var clienteDNI = $("#txtIdentidadBusqueda").val();
        var cliente = $("#txtClienteBusqueda").val();
        var fecha = new Date().toLocaleDateString();
        var subtotal = $("#subtotal").text();
        var impuesto = $("#isv15").text();
        var total = $("#totalPagar").text();
        console.log(impuesto);
        console.log(total);
        console.log('SUBTOTAL ' + subtotal);
        console.log('DNI ' + clienteDNI);
        console.log('Cliente ' + cliente);

        console.log('LOCAL STORAGE' + idcompra);
     
        if (id) {
            console.log('ENTREE');
            idcompra = id;
        }
        console.log('ID OTRA VEX' + idcompra);

        try {
            $.ajax({
                url: '../Services/comprasDetalles_obtener.php',
                type: 'GET',
                data: {
                    id: idcompra
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    const {
                        jsPDF
                    } = window.jspdf;
                    const doc = new jsPDF({
                        orientation: 'portrait',
                        unit: 'px',
                        format: 'letter'
                    });
                    const img = new Image();
                    img.src = '../Views/Resources/dist/img/logroRac.jpg';

                    const addHeader = () => {
                        // Dibujar fondo del encabezado
                        drawPolygonBackground(doc);

                        // Dibujar la sombra
                        const imgX = 20;
                        const imgY = 40;
                        const imgWidth = 70;
                        const imgHeight = 60;
                        const cornerRadius = 10;
                        const shadowOffset = 5;
                        doc.setFillColor(150, 150, 150); // Color de la sombra
                        doc.roundedRect(imgX + shadowOffset, imgY + shadowOffset, imgWidth, imgHeight, cornerRadius, cornerRadius, 'F');

                        // Dibujar el rectángulo para la imagen
                        drawRoundedRect(doc, imgX, imgY, imgWidth, imgHeight, cornerRadius, [214, 39, 0]);
                        doc.addImage(img, 'PNG', imgX, imgY, imgWidth, imgHeight);

                        // Agregar el texto del encabezado
                        doc.setTextColor(0, 0, 0);
                        doc.setFontSize(25);
                        doc.setFont('helvetica', 'bold');
                        doc.text('Compras', 200, 90, {
                            align: 'left'
                        });

                        // Agregar fecha, DNI del cliente y nombre del cliente en nuevas líneas
                        doc.setFontSize(15);
                        const lineHeight = 20; // Espacio vertical entre líneas
                        doc.text(`Fecha: ${fecha}`, imgX + imgWidth - 55, imgY + 90);
                        doc.text(`DNI Cliente: ${clienteDNI}`, imgX + imgWidth - 55, imgY + 90 + lineHeight);
                        doc.text(`Cliente: ${cliente}`, imgX + imgWidth - 55, imgY + 90 + 2 * lineHeight);
                    };

                    const addFooter = (pageNumber, pageCount) => {
                        doc.setFillColor(247, 247, 247);
                        doc.rect(doc.internal.pageSize.getWidth() - 80, doc.internal.pageSize.getHeight() - 35, 60, 25, 'F');
                        doc.setFontSize(13);
                        doc.setTextColor(0);
                        doc.text(`Página ${pageNumber} de ${pageCount}`, doc.internal.pageSize.getWidth() - 50, doc.internal.pageSize.getHeight() - 22, {
                            align: 'center'
                        });
                        const fechaImpresion = new Date().toLocaleDateString();
                        doc.text(`Usuario: 'Hola'      Fecha: ${fechaImpresion}`, 10, doc.internal.pageSize.getHeight() - 22);
                        doc.setFillColor(241, 10, 10);
                        doc.rect(0, doc.internal.pageSize.getHeight() - 20, doc.internal.pageSize.getWidth(), 20, 'F');
                    };

                    const cuerpoConNumeros = data.map((row, index) => [
                        index + 1,
                        row.Veh_Placa,
                        row.Veh_Color,
                        row.Mod_Descripcion,
                        row.Mod_Año,
                        row.Mar_Descripcion
                    ]);

                    doc.autoTable({
                        head: [
                            ['N.', 'Placa', 'Color', 'Modelo', 'Año', 'Marca']
                        ],
                        body: cuerpoConNumeros,
                        startY: 180,
                        theme: 'grid',
                        styles: {
                            fontSize: 12,
                            cellPadding: 5,
                            textColor: [0, 0, 0],
                            valign: 'middle',
                            halign: 'center'
                        },
                        headStyles: {
                            fillColor: [0, 0, 0],
                            textColor: [255, 255, 255],
                            fontStyle: 'bold'
                        },
                        alternateRowStyles: {
                            fillColor: [240, 240, 240]
                        },
                        didDrawPage: (data) => {
                            addHeader();
                            const pageCount = doc.getNumberOfPages();
                            addFooter(data.pageNumber, pageCount);
                        },
                        margin: {
                            top: 140
                        }
                    });

                    // Agregar filas para Subtotal, Impuesto y Total a Pagar
                    doc.autoTable({
                        body: [
                            ['Subtotal:', subtotal],
                            ['Impuesto:', impuesto],
                            [{
                                content: 'Total a Pagar:',
                                styles: {
                                    fontStyle: 'bold',
                                    fillColor: [241, 10, 10],
                                    textColor: [255, 255, 255],
                                    fontSize: 15
                                }
                            }, {
                                content: total,
                                styles: {
                                    fontStyle: 'bold',
                                    fontSize: 15
                                }
                            }]
                        ],
                        startY: doc.autoTableEndPosY() + 10, // Ajustar el inicio para que esté justo después de la tabla anterior
                        theme: 'plain',
                        styles: {
                            fontSize: 12,
                            textColor: [0, 0, 0],
                            halign: 'right',
                            valign: 'middle'
                        },
                        headStyles: {
                            fontStyle: 'bold',
                            fillColor: [255, 255, 255],
                            textColor: [0, 0, 0]
                        },
                        columnStyles: {
                            0: {
                                halign: 'left',
                                columnWidth: 80
                            }
                        }
                    });

                    const pdfDataUri = doc.output('datauristring');
                    document.getElementById('pdfEmbed').setAttribute('src', pdfDataUri);

                    $('#pdfPreview').collapse('show');
                    $("#insertarEncabezado").hide();

                }
            });
        } catch (error) {
            console.error('Error generating report:', error.message);
        }
    }







    // Función para dibujar el fondo de polígono
    function drawPolygonBackground(doc) {
        const width = 330;
        const height = 95;
        const x = 1;
        const y = 3;

        const points = [
            [x, y],
            [x + width, y],
            [x + width, y],
            [x + 0.9 + width, y + height],
            [x, y + height]
        ];

        doc.setFillColor(241, 10, 10);
        doc.setDrawColor(104, 200, 0);
        doc.lines(points, x, y, [1, 1], 'F');
    }

    // Función para dibujar un rectángulo con esquinas redondeadas
    function drawRoundedRect(doc, x, y, width, height, radius, color) {
        doc.setFillColor(...color);
        doc.roundedRect(x, y, width, height, radius, radius, 'F');
    }




    function validateForm() {
        let isValid = true;
        document.querySelectorAll('.error-message').forEach(function(error) {
            error.textContent = '';
        });
        document.querySelectorAll('.form-control, .form-check-input').forEach(function(input) {
            input.classList.remove('is-invalid');
        });

        const identidad = document.getElementById('txtIdentidad');
        if (!identidad.value) {
            document.getElementById('errorIdentidad').textContent = 'El campo es requerido';
            identidad.classList.add('is-invalid');
            isValid = false;
        } else if (identidad.value.length !== 13) {
            document.getElementById('errorIdentidadLongitud').textContent = 'El campo debe tener 13 caracteres';
            identidad.classList.add('is-invalid');
            isValid = false;
        }


        const nombre = document.getElementById('txtNombre');
        if (!nombre.value) {
            document.getElementById('errorNombre').textContent = 'El campo es requerido';
            nombre.classList.add('is-invalid');
            isValid = false;
        }

        const apellido = document.getElementById('txtApellido');
        if (!apellido.value) {
            document.getElementById('errorApellido').textContent = 'El campo es requerido';
            apellido.classList.add('is-invalid');
            isValid = false;
        }


        const sexo = document.querySelector('input[name="rbSexo"]:checked');
        if (!sexo) {
            document.getElementById('errorSexo').textContent = 'El campo es requerido';
            document.getElementById('rbfemenino').classList.add('is-invalid');
            document.getElementById('rbmasculino').classList.add('is-invalid');
            isValid = false;
        }


        const fecha = document.getElementById('txtFechaNacimiento');
        if (!fecha.value) {
            document.getElementById('errorFecha').textContent = 'El campo es requerido';
            fecha.classList.add('is-invalid');
            isValid = false;
        }

        const ciudad = document.getElementById('ciudadSelect');
        if (!ciudad.value || ciudad.value == '0') {
            document.getElementById('errorCiudad').textContent = 'El campo es requerido';
            ciudad.classList.add('is-invalid');
            isValid = false;
        }

        const esciv = document.getElementById('estadoCivilSelect');
        if (!esciv.value || esciv.value == '0') {
            document.getElementById('errorEsciv').textContent = 'El campo es requerido';
            esciv.classList.add('is-invalid');
            isValid = false;
        }


        const direccion = document.getElementById('txtDireccion');
        if (!direccion.value) {
            document.getElementById('errorDireccion').textContent = 'El campo es requerido';
            direccion.classList.add('is-invalid');
            isValid = false;
        }


        return isValid;
    }

    function validateFormEncabezado() {
        let isValid = true;
        document.querySelectorAll('.error-message').forEach(function(error) {
            error.textContent = '';
        });
        document.querySelectorAll('.form-control, .form-check-input').forEach(function(input) {
            input.classList.remove('is-invalid');
        });


        const clienteBusqueda = document.getElementById('txtClienteBusqueda');
        if (!clienteBusqueda.value) {
            document.getElementById('errorClienteBusqueda').textContent = 'El campo es requerido';
            clienteBusqueda.classList.add('is-invalid');
            isValid = false;
        }

        const metodo = document.getElementById('pagosSelect');
        if (!metodo.value || metodo.value == '0') {
            document.getElementById('errorMetodoPago').textContent = 'El campo es requerido';
            metodo.classList.add('is-invalid');
            isValid = false;
        }

        return isValid;
    }

    function validateFormVehiculo() {
        let isValid = true;
        document.querySelectorAll('.error-message').forEach(function(error) {
            error.textContent = '';
        });
        document.querySelectorAll('.form-control, .form-check-input').forEach(function(input) {
            input.classList.remove('is-invalid');
        });


        const placa = document.getElementById('txtPlaca');
        if (!placa.value) {
            document.getElementById('errorPlaca').textContent = 'El campo es requerido';
            placa.classList.add('is-invalid');
            isValid = false;
        } else if (placa.value.length !== 7) {
            document.getElementById('errorPlacaLongitud').textContent = 'El campo debe tener 7 caracteres';
            placa.classList.add('is-invalid');
            isValid = false;
        }

        const color = document.getElementById('txtColor');
        if (!color.value) {
            document.getElementById('errorColor').textContent = 'El campo es requerido';
            color.classList.add('is-invalid');
            isValid = false;
        }

        const imagen = document.getElementById('txtImagen');
        if (!imagen.value) {
            document.getElementById('errorImagen').textContent = 'El campo es requerido';
            imagen.classList.add('is-invalid');
            isValid = false;
        }

        const precio = document.getElementById('txtPrecioVehiculo');
        if (!precio.value) {
            document.getElementById('errorPrecio').textContent = 'El campo es requerido';
            precio.classList.add('is-invalid');
            isValid = false;
        }

        const modelo = document.getElementById('modeloSelect');
        if (!modelo.value || modelo.value == '0') {
            document.getElementById('errorModelo').textContent = 'El campo es requerido';
            modelo.classList.add('is-invalid');
            isValid = false;
        }

        return isValid;
    }


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
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        if (localStorage.getItem('operacionExitosa') === 'true') {
            Toast.fire({
                icon: 'success',
                title: 'Operación Realizada Con Éxito.'
            });
            localStorage.removeItem('operacionExitosa'); // Limpiar la señal para futuras operaciones
        }

        if (localStorage.getItem('operacionExitosa2') === 'true') {
            Toast.fire({
                icon: 'success',
                title: 'Operación Realizada Con Éxito.'
            });
            localStorage.removeItem('operacionExitosa2'); // Limpiar la señal para futuras operaciones
        }
        var encabezadoInsertado = false; // Variable de control para evitar insertar el encabezado más de una vez
        $("#detalleCompra2").hide();


        $(".btnVolverImpresion").click(function() {
            console.log('OFDF');
            $('#pdfPreview').collapse('hide');
            $("#insertarEncabezado").show();
        });

        // Evento de tecla para buscar cliente por DNI
        $("#txtIdentidadBusqueda").on("keyup", function() {
            const dni = $(this).val();
            if (dni.length === 13) {
                console.log('13');

                $.ajax({
                    url: '../Services/cliente_Buscar.php',
                    type: 'GET',
                    data: {
                        id: dni
                    },
                    success: function(response) {
                        const usuario = JSON.parse(response);

                        if (usuario != false) {
                            $("#txtClienteBusqueda").val(usuario.Cli_Nombre + ' ' + usuario.Cli_Apellido);
                            var IdCliente = usuario.Cli_Id;
                            $("#IdCliente").val(IdCliente);
                            console.log('ID CLIENTE: ' + IdCliente);
                        } else {
                            $("#txtClienteBusqueda").val('');
                            $("#IdCliente").val('0');
                        }

                    }
                });


            }
        });


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


            if (validateFormEncabezado()) {
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
            $("#detalleCompra").show();

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


        $("#btnGuardarCliente").click(function() {

            if (validateForm()) {
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
                        Toast.fire({
                            icon: 'success',
                            title: 'Cliente Ingresado Con Exito.'
                        });
                    },
                    error: function() {
                        alert("Error en la solicitud AJAX");
                    }
                });
            }




        });


        $("#btnEliminarDetalle").click(function() {
            console.log("ENTOOOOO");
            $("#modalEliminarDetalle").show();
        });

        // Enviar formulario de vehiculo y luego insertar encabezado y detalle
        $("#btnGuardarVehiculo").click(function() {

            if (validateFormVehiculo()) {
                var formData = new FormData($("#frmInsertarVehiculo")[0]);

                // Extraer el nombre del archivo
                var fileName = $("#txtImagen").val().split('\\').pop();
                formData.append("txtImagen", fileName);
                var Precio = $("#txtPrecioVehiculo").val();
                formData.append("txtPrecioVehiculo", Precio);
                var id = $("#id").val();
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

                        $(".btnFinalizarCreate").prop('disabled', false);
                        $("#pagosSelect").prop('disabled', true);
                        // Insertar el encabezado después de insertar el vehículo
                        insertarEncabezado();


                    },
                    error: function() {
                        alert("Error en la solicitud AJAX");
                    }
                });
            }

        });

        function insertarEncabezado() {

            var compraID = $("#CompraId").val();
            var compraIDSumado = parseInt(compraID) + 1; // Sumar 1 al valoCr de ompraId

            if (!encabezadoInsertado) {
                var pagosSelect = $("#pagosSelect").val();
                var txtIdentidadBusqueda = $("#txtIdentidadBusqueda").val();
                var txtClienteBusqueda = $("#txtClienteBusqueda").val();
                var IdCliente = $("#IdCliente").val();
                console.log('IIDE CLIENTE' + IdCliente);
                var id = $("#id").val();

                console.log('COMPRA ID: ' + compraIDSumado);

                $.ajax({
                    type: "POST",
                    url: "", // URL del script PHP
                    data: {
                        formulario: 'insertarEncabezado',
                        pagosSelect: pagosSelect,
                        txtIdentidadBusqueda: txtIdentidadBusqueda,
                        txtClienteBusqueda: txtClienteBusqueda,
                        IdCliente: IdCliente,
                        id: id
                    },
                    success: function(response) {

                        console.log("Encabezado insertado correctamente", compraIDSumado);

                        encabezadoInsertado = true;
                        if (id) {
                            insertarDetalle(id);
                        } else {
                            localStorage.setItem('compraIDSumado', compraIDSumado); //
                            insertarDetalle(compraIDSumado); // Pasar el ID de la compra al insertar el detalle
                        }


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
                    Toast.fire({
                        icon: 'success',
                        title: 'Operacion Realizada Con Exito.'
                    });
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
                    <td class="text-center">${detalle.Veh_Placa}</td>
                    <td class="text-center">${detalle.Veh_Color}</td>
                    <td class="text-center">${detalle.Mod_Descripcion}</td>
                    <td class="text-center">${detalle.Mod_Año}</td>
                    <td class="text-center">${detalle.Mar_Descripcion}</td>
                    <td class="d-flex justify-content-center"><div class="col-md-6"><input type="text" class="form-control precioCompra" name="precioCompra[]" value="${detalle.Cdt_PrecioCompra}"></div></td>
                
                    <td class="text-center"><button type="button" class="btn btn-danger btn-sm btnEliminarDetalle" data-id="${detalle.Cdt_Id}"><i class="fa-solid fa-trash"></i></button></td>
                </tr>`;
                        tbody.append(fila);
                    });
                    $("#detalleCompra").show();

                    // Recalcular totales
                    recalcularTotales();

                    // Añadir evento para recalcular totales cuando se modifique el precio
                    $('.precioCompra').on('input', function() {
                        console.log('NETRE 2')
                        recalcularTotales();
                    });
                },
                error: function() {
                    alert("Error al cargar los detalles de la compra");
                }
            });
        }

        function cargarDetallesCompra2(compraId) {
            $.ajax({
                type: "GET",
                url: "comprasDetalles_obtener.php",
                data: {
                    id: compraId
                },
                success: function(response) {
                    var detalles = JSON.parse(response);
                    console.log("DETALLES :" + detalles);
                    var tbody = $("#detalleCompra2 tbody");
                    tbody.empty(); // Limpiar tabla

                    detalles.forEach(function(detalle) {
                        var fila = `<tr>
                    <td class="text-center">${detalle.Veh_Placa}</td>
                    <td class="text-center">${detalle.Veh_Color}</td>
                    <td class="text-center">${detalle.Mod_Descripcion}</td>
                    <td class="text-center">${detalle.Mod_Año}</td>
                    <td class="text-center">${detalle.Mar_Descripcion}</td>
                    <td class="text-center">${detalle.Cdt_PrecioCompra}</td>
                
                </tr>`;
                        tbody.append(fila);
                    });
                    $("#detalleCompra2").show();


                },
                error: function() {
                    alert("Error al cargar los detalles de la compra");
                }
            });
        }

        function recalcularTotales() {
            var subtotal = 0;
            $('.precioCompra').each(function() {
                var precio = parseFloat($(this).val()) || 0;
                subtotal += precio;
            });

            var isv = subtotal * 0.15;
            var total = subtotal + isv;

            $('#subtotal').text('L ' + subtotal.toFixed(2));
            $('#isv15').text('L ' + isv.toFixed(2));
            $('#totalPagar').text('L ' + total.toFixed(2));
        }


        // Manejar el evento de clic en el botón de eliminar detalle
        $(document).on('click', '.btnFinalizarIndex', function() {
            let idDetalleAEliminar = $(this).data('id');
            console.log("ID DETALLE: " + idDetalleAEliminar)
            $('#modalFinalizar').data('id', idDetalleAEliminar).modal('show');
        });

        // Manejar el evento de clic en el botón de eliminar detalle
        $(document).on('click', '.btnFinalizarCreate', function() {

            var compraIDSumado = localStorage.getItem('compraIDSumado'); // Obtener de local storage
            console.log("ID DETALLE: " + compraIDSumado)
            $('#modalFinalizarCreate').data('id', compraIDSumado).modal('show');
        });

        // Manejar la confirmación de eliminación en el modal
        $('#btnConfirmarFinalizarCreate').click(function() {
            let idDetalleAEliminar = $('#modalFinalizarCreate').data('id');

            $.ajax({
                type: "GET",
                url: "compra_Finalizar.php", // URL del script PHP para eliminar el detalle
                data: {
                    id: idDetalleAEliminar
                },
                success: function(response) {
                    $('#modalFinalizarCreate').modal('hide');

                    localStorage.setItem('operacionExitosa2', 'true'); // Guardar señal en local storage
                    window.location.reload();
                },
                error: function() {
                    alert("Error al eliminar el detalle");
                }
            });
        });

        // Manejar la confirmación de eliminación en el modal
        $('#btnConfirmarFinalizar').click(function() {
            let idDetalleAEliminar = $('#modalFinalizar').data('id');
            var compraIDSumado = localStorage.getItem('compraIDSumado'); // Obtener de local storage
            $.ajax({
                type: "GET",
                url: "compra_Finalizar.php", // URL del script PHP para eliminar el detalle
                data: {
                    id: idDetalleAEliminar
                },
                success: function(response) {
                    $('#modalFinalizar').modal('hide');

                    localStorage.setItem('operacionExitosa', 'true'); // Guardar señal en local storage
                    window.location.reload();
                },
                error: function() {
                    alert("Error al eliminar el detalle");
                }
            });
        });


        // Manejar el evento de clic en el botón de eliminar detalle
        $(document).on('click', '.btnEliminarDetalle', function() {
            let idDetalleAEliminar = $(this).data('id');
            console.log("ID DETALLE: " + idDetalleAEliminar)
            $('#modalEliminarDetalle').data('id', idDetalleAEliminar).modal('show');
        });

        // Manejar la confirmación de eliminación en el modal
        $('#btnConfirmarEliminarDetalle').click(function() {
            let idDetalleAEliminar = $('#modalEliminarDetalle').data('id');
            var compraIDSumado = localStorage.getItem('compraIDSumado'); // Obtener de local storage
            $.ajax({
                type: "GET",
                url: "comprasDetalle_eliminar.php", // URL del script PHP para eliminar el detalle
                data: {
                    id: idDetalleAEliminar
                },
                success: function(response) {
                    $('#modalEliminarDetalle').modal('hide');
                    console.log("ID LOCAL: " + compraIDSumado)
                    cargarDetallesCompraEliminado();
                    Toast.fire({
                        icon: 'success',
                        title: 'Operacion Realizada Con Exito.'
                    });
                    console.log("EXITO")
                },
                error: function() {
                    alert("Error al eliminar el detalle");
                }
            });
        });

        function cargarDetallesCompraEliminado() {
            var compraIDSumado = localStorage.getItem('compraIDSumado'); // Obtener de local storage

            if (!compraIDSumado) {
                alert("No hay un ID de compra disponible.");
                return;
            }
            $.ajax({
                type: "GET",
                url: "comprasDetalles_obtener.php",
                data: {
                    id: compraIDSumado
                },
                success: function(response) {
                    console.log("Respuesta del servidor:", response); // Log de la respuesta

                    var detalles = JSON.parse(response);
                    console.log("DETALLES :", detalles);

                    var tbody = $("#detalleCompra tbody");
                    tbody.empty(); // Limpiar tabla


                    detalles.forEach(function(detalle) {
                        if (detalle.Veh_Placa == null) {
                            console.log("SIN DATOS");
                            tbody.append('<tr><td colspan="8" class="text-center">No hay detalles de compra disponibles</td></tr>');
                        } else {
                            var fila = `<tr>
                    <td>${detalle.Veh_Placa}</td>
                    <td>${detalle.Veh_Color}</td>
                    <td>${detalle.Mod_Descripcion}</td>
                    <td>${detalle.Mod_Año}</td>
                    <td>${detalle.Mar_Descripcion}</td>
                    <td><input type="text" class="form-control" name="precioCompra[]" value="${detalle.Cdt_PrecioCompra}"></td>
                    <td>${detalle.Imp_ISV}</td>
                    <td><button type="button" class="btn btn-danger btn-sm btnEliminarDetalle" data-id="${detalle.Cdt_Id}"><i class="fa-solid fa-trash"></i></button></td>
                </tr>`;
                            tbody.append(fila);
                        }

                    });
                    $("#detalleCompra").show();
                },
                error: function() {
                    alert("Error al cargar los detalles de la compra");
                }
            });
        }



        function attachClickEvents() {
            $(".abrir-editar").off('click').on('click', function() {
                const id = $(this).data('id');
                $(".btnFinalizarCreate").prop('disabled', false);
                console.log('ID COMPRA: ' + id)
                $.ajax({
                    url: '../Services/compra_obtener.php',
                    type: 'GET',
                    data: {
                        IdCompra: id
                    },
                    success: function(response) {
                        const usuario = JSON.parse(response);
                        console.log('EDITAR: ' + usuario)
                        $("#form-title").text('Editar Compra');
                        console.log(response);
                        $("#id").val(id);
                        $("#pagosSelect").val(usuario.Mpg_ID);
                        $("#txtIdentidadBusqueda").val(usuario.Cli_DNI);
                        $("#txtClienteBusqueda").val(usuario.Cli_Nombre + ' ' + usuario.Cli_Apellido);
                        // $("#txtDireccion").val(usuario.Cli_Direccion);
                        // $("#txtApellido").val(usuario.Cli_Apellido);
                        // $("#txtFechaNacimiento").val(usuario.Cli_FechaNac);


                        cargarDetallesCompra(id);

                        // $("#departamentoSelect").val(usuario.Dep_ID);


                        $("#insertarEncabezado").show();
                        $("#tabla").hide();
                    }
                });
            });

            $(".btn-detalles").off('click').on('click', function() {
                const id = $(this).data('id');
                console.log('ESTE ES EL ID: ' + id)
                $.ajax({
                    url: '../Services/compra_obtener.php',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        const usuario = JSON.parse(response);
                        console.log(response);
                        $("#Detalle_Codigo").text(id);
                        $("#Detalle_Fecha").text(usuario.Com_Fecha);
                        $("#Detalle_Pago").text(usuario.Mpg_Descripcion);
                        $("#Detalle_DNI").text(usuario.Cli_DNI);
                        $("#Detalle_Cliente").text(usuario.Cli_Nombre + ' ' + usuario.Cli_Apellido);
                        $("#Detalle_Creacion").text(usuario.Creacion);
                        $("#Detalle_FechaCreacion").text(usuario.Com_Fecha_Creacion);
                        $("#Detalle_Modifica").text(usuario.Modifica);
                        $("#Detalle_FechaModifica").text(usuario.Com_Fecha_Modifica);
                        $("#tabla").hide();
                        $("#detalles").show();
                    }
                });
                $.ajax({
                    url: '../Services/compra_obtener.php',
                    type: 'GET',
                    data: {
                        IdCompra: id
                    },
                    success: function(response) {
                        const usuario = JSON.parse(response);
                        console.log('EDITAR: ' + usuario)
                        $("#form-title").text('Detalle Compra');


                        $("#Detalle_Codigo").text(id);
                        $("#Detalle_DNI").text(usuario.Cli_DNI);
                        $("#Detalle_Fecha").text(usuario.Com_Fecha);
                        $("#Detalle_Pago").text(usuario.Mpg_Descripcion);
                        $("#Detalle_Cliente").text(usuario.Cli_Nombre + ' ' + usuario.Cli_Apellido);

                        $("#Detalle_Creacion").text(usuario.Creacion);

                        $("#Detalle_FechaCreacion").text(usuario.Com_Fecha_Creacion);
                        $("#Detalle_Modifica").text(usuario.Modifica);
                        $("#Detalle_FechaModifica").text(usuario.Com_Fecha_Modifica);
                        cargarDetallesCompra2(id);


                        $("#detalles").show();
                        $("#tabla").hide();
                    }
                });
            });




        }
        attachClickEvents();

        table.on('draw', function() {
            attachClickEvents();
        });

        $("#btnVolver").click(function() {
            $("#detalles").hide();
            $("#tabla").show();
        });



    });
</script>