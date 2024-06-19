<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../Services/CompraVehiculoService.php';
require_once '../Services/ClienteService.php';

$controllerCompra = new CompraVehiculoService();
$controllerCliente = new ClienteService();

$response = array("status" => "error", "message" => "Ocurrió un error");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // header('Content-Type: application/json');

    if (isset($_POST['formulario']) && $_POST['formulario'] == 'insertarEncabezado') {
        $FechaCompra = $_POST['txtFecha'];
        $MetodoPago = $_POST['pagosSelect'];
        $IdentidadBusqueda = $_POST['txtIdentidadBusqueda'];
        $ClienteBusqueda = $_POST['txtClienteBusqueda'];

        try {
            $Creacion = $_SESSION['ID'];
            $resultadoEncabezado = $controllerCompra->insertarEncabezado($FechaCompra, $MetodoPago, $ClienteBusqueda, $Creacion);
            $response = array("status" => "success", "message" => "Encabezado insertado correctamente");
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }
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
            $Creacion = $_SESSION['ID'];
            $clienteID = $controllerCliente->insertar($nombre, $apellido, $FechaNacimiento, $Sexo, $Identidad, $Ciudad, $Esciv, $Direccion, $Creacion);
            $response = array("status" => "success", "message" => "Cliente insertado correctamente", "clienteID" => $clienteID);
        } catch (Exception $e) {
            $response = array("status" => "error", "message" => $e->getMessage());
        }
    } elseif (isset($_POST['formulario']) && $_POST['formulario'] == 'insertarVehiculo') {
        $Placa = $_POST['txtPlaca'];
        $Color = $_POST['txtColor'];
        $PrecioVehiculo = $_POST['txtPrecioVehiculo'];
        $ModeloVehiculo = $_POST['modeloSelect'];
        $Imagen = $_POST['txtImagen']; // Solo el nombre del archivo

        try {
            $Creacion = $_SESSION['ID'];
            $resultadoVehiculo = $controllerCompra->insertarVehiculo($Placa, $Color, $Imagen, $PrecioVehiculo, $ModeloVehiculo, $Creacion);
            $response = $resultadoVehiculo;
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }
    }

    echo json_encode($response);
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
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fecha de Compra: </label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="txtFecha" id="txtFecha" disabled>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3">

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
                                <input type="text" class="form-control" id="txtClienteBusqueda" name="txtClienteBusqueda">
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

                <div class="card-footer">
                    <div class="d-flex justify-content-end" style="gap:10px">
                        <button type="button" class="btn btn-primary" id="btnGuardar"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                        <button type="button" class="btn btn-primary" id="btnFinalizar"><i class="fa-solid fa-check"></i> Finalizar</button>
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

        $("#btnAgregarVehiculo").click(function() {
            $("#insertarVehiculo").show();
            $("#insertarEncabezado").hide();
        });


        $("#btnVolverVehiculo").click(function() {
            if ($("#txt"))
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
        });


        $("#Cancelar").click(function() {
            $("#insertar").hide();
            $("#tabla").show();
            $("#insertarEncabezado").hide();
            clearErrors();
        });

        // Enviar formularios
        $("#btnGuardar").click(function() {
            $("#frmInsertarEncabezado").submit();
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


        $("#btnGuardarVehiculo").click(function() {
            var formData = new FormData($("#frmInsertarVehiculo")[0]);

            // Extraer el nombre del archivo
            var fileName = $("#txtImagen").val().split('\\').pop();
            formData.append("txtImagen", fileName);

            $.ajax({
                type: "POST",
                url: "", // URL del script PHP
                data: formData,
                contentType: false,
                processData: false,
                success: function(resultadoVehiculo) {
                    console.log('RESPONSE: ' + resultadoVehiculo);


                    alert(resultadoVehiculo.message);
                    $("#frmInsertarVehiculo")[0].reset();
                    $("#insertarVehiculo").hide();
                    $("#insertarEncabezado").show();

                },
                error: function() {
                    alert("Error en la solicitud AJAX");
                }
            });
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