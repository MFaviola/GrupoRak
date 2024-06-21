<?php
require_once '../Services/ClienteService.php';

$controller = new ClienteService();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nombre = $_POST['txtNombre'];
    $apellido = $_POST['txtApellido'];
    $FechaNacimiento = $_POST['txtFechaNacimiento'];
    $Sexo = $_POST['rbSexo'];
    $Identidad = $_POST['txtIdentidad'];
    $Ciudad = $_POST['ciudadSelect'];
    $Esciv = $_POST['estadoCivilSelect'];
    $Direccion = $_POST['txtDireccion'];


    try {
        if ($id) {
            $Modifica = $_SESSION['ID'];
            // $Modifica = 1;
            $resultado = $controller->actualizar($id, $nombre, $apellido, $FechaNacimiento, $Sexo, $Identidad, $Ciudad, $Esciv, $Direccion, $Modifica);
        } else {
            $Creacion = 1;
            $resultado = $controller->insertar($nombre, $apellido, $FechaNacimiento, $Sexo, $Identidad, $Ciudad, $Esciv, $Direccion, $Creacion);
        }
        //echo '<div class="alert alert-success">' . $resultado . '</div>';
    } catch (Exception $e) {
        //echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
    }
}

try {
    $clientes = $controller->listarClientes();
    $estadosCiviles = $controller->listarEstadosCiviles();
    $ciudades = $controller->CiudadesDDl(0);
    $departamentos = $controller->listarDepartamentos();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}


?>

<div id="tabla">
    <div class="card">
        <div class="card-body">
            <h2 class="text-center" style="font-size:34px !important">Clientes</h2>

            <button class="btn btn-primary" id="btnNuevo">
                <i class="fa-solid fa-plus"></i>
                Nuevo
            </button>
            <hr>
            <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Identidad</th>
                        <th>Nombre Completo</th>
                        <th>Sexo</th>
                        <th>Fecha Nacimiento</th>
                        <th>Ciudad</th>
                        <th>Estado Civil</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente) : ?>
                        <tr>
                            <td><?php echo $cliente['Cli_Id']; ?></td>
                            <td><?php echo $cliente['Cli_DNI']; ?></td>
                            <td><?php echo $cliente['Cli_Nombre']; ?></td>
                            <td><?php echo $cliente['Cli_Sexo']; ?></td>
                            <td><?php echo $cliente['Cli_FechaNac']; ?></td>
                            <td><?php echo $cliente['Ciu_Descripcion']; ?></td>
                            <td><?php echo $cliente['Est_Descripcion']; ?></td>
                            <td class="d-flex justify-content-center" style="gap:10px">

                                <button style="color:white" class="btn btn-primary btn-sm abrir-editar" data-id="<?php echo $cliente['Cli_Id']; ?>"><i class="fas fa-edit"></i>Editar</button>
                                <button class="btn btn-secondary btn-sm btn-detalles" data-id="<?php echo $cliente['Cli_Id']; ?>"><i class="fas fa-eye"></i>Detalles</button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-eraser"></i> Eliminar</button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Formulario de Usuario -->
<div id="insertar" style="display:none;">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title" id="form-title">Nuevo Cliente</h3>
        </div>
        <div class="card-body">
            <form id="frmInsertar" method="POST">
                <input type="hidden" name="id" id="id">
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
                        <button type="button" class="btn btn-primary" id="btnGuardarUsuario"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                        <button type="button" id="Cancelar" class="btn btn-secondary"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Detalles -->
<div id="detalles" style="display:none;">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title" id="form-title">Detalle Cliente</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Codigo:</strong> <span id="Detalle_Codigo"></span></p>
                    <p><strong>Identidad:</strong> <span id="Detalle_Identidad"></span></p>
                </div>
                <div class="col-md-4">
                    <p><strong>Nombre:</strong> <span id="Detalle_Nombre"></span></p>
                    <p><strong>Apellido:</strong> <span id="Detalle_Apellido"></span></p>

                </div>
                <div class="col-md-4">
                    <p><strong>Fecha Nacimiento:</strong> <span id="Detalle_FechaNacimiento"></span></p>
                    <p><strong>Sexo:</strong> <span id="Detalle_Sexo"></span></p>
                </div>

            </div>
            <div class="mt-1 row">
                <div class="col-md-4">
                    <p><strong>Estado Civil:</strong> <span id="Detalle_Esciv"></span></p>
                    <p><strong>Direccion:</strong> <span id="Detalle_Direccion"></span></p>
                </div>

                <div class="col-md-4">
                    <p><strong>Ciudad:</strong> <span id="Detalle_Ciudad"></span></p>
                    <p><strong>Departamento:</strong> <span id="Detalle_Departamento"></span></p>
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

<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnConfirmarEliminar"><i class="fa-solid fa-trash"></i> Eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- Formulario oculto para la eliminación del usuario -->
<form id="eliminarUsuarioForm" method="POST" action="../Services/cliente_eliminar.php" style="display:none;">
    <input type="hidden" name="id" id="eliminarUsuarioId">
</form>

<!-- jQuery -->

<script src="../Views/Resources/plugins/jquery/jquery.min.js"></script>



<script>
    

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

    $(document).ready(function() {
        $("#EsquemaGeneral").addClass('menu-open');
        $("#LinkGeneral").addClass('active');
        var clienteactivo = $("#LinkItemGeneral").text();
        console.log('ES CLIENTE?' + clienteactivo)
        console.log()
    
      // Función para cargar ciudades basadas en el departamento seleccionado
      
    function cargarCiudades(departamentoId, ciudadId) {
        if (departamentoId != 0) {
            $.ajax({
                url: '../Services/ciudades_obtener.php',
                type: 'GET',
                data: { id: departamentoId },
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

    $('#departamentoSelect').change(function() {
        var departamentoId = $(this).val();
        console.log('ID DEPARTAMENTO' + departamentoId)
        cargarCiudades(departamentoId);
    });

    // Inicialización de DataTables
    var table = $("#example1").DataTable({
        "responsive": false,
        "lengthChange": false,
        "autoWidth": false,
    });

    function attachClickEvents() {
        $(".abrir-editar").off('click').on('click', function() {
            const id = $(this).data('id');
            $.ajax({
                url: '../Services/cliente_obtener.php',
                type: 'GET',
                data: { id: id },
                success: function(response) {
                    const usuario = JSON.parse(response);
                    $("#form-title").text('Editar Cliente');
                    $("#id").val(usuario.Cli_Id);
                    $("#txtNombre").val(usuario.Cli_Nombre);
                    $("#txtIdentidad").val(usuario.Cli_DNI);
                    $("#txtDireccion").val(usuario.Cli_Direccion);
                    $("#txtApellido").val(usuario.Cli_Apellido);
                    $("#txtFechaNacimiento").val(usuario.Cli_FechaNac);

                    if (usuario.Cli_Sexo === "Femenino") {
                        $("#rbfemenino").prop("checked", true);
                    } else if (usuario.Cli_Sexo === "Masculino") {
                        $("#rbmasculino").prop("checked", true);
                    }

                    $("#estadoCivilSelect").val(usuario.Est_ID);
                    $("#departamentoSelect").val(usuario.Dep_ID);

                    // Cargar las ciudades y seleccionar la ciudad correspondiente
                    const prueba1 = usuario.Dep_ID;
                    const prueba2 = usuario.Ciu_Id;
                    console.log('PRUEBA 1: ' + prueba1);
                    console.log('PRUEBA 2: ' + prueba2);

                    cargarCiudades(prueba1, prueba2);

                    $("#insertar").show();
                    $("#tabla").hide();
                }
            });
        });

            $(".btn-detalles").off('click').on('click', function() {
                const id = $(this).data('id');
                console.log('ESTE ES EL ID: ' + id)
                $.ajax({
                    url: '../Services/cliente_obtener.php',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        const usuario = JSON.parse(response);


                        $("#Detalle_Codigo").text(id);
                        $("#Detalle_Nombre").text(usuario.Cli_Nombre);
                        $("#Detalle_Identidad").text(usuario.Cli_DNI);
                        $("#Detalle_Direccion").text(usuario.Cli_Direccion);
                        $("#Detalle_Apellido").text(usuario.Cli_Apellido);
                        $("#Detalle_FechaNacimiento").text(usuario.Cli_FechaNac);
                        $("#Detalle_Sexo").text(usuario.Cli_Sexo);
                        $("#Detalle_Ciudad").text(usuario.Ciu_Descripcion);
                        $("#Detalle_Esciv").text(usuario.Est_Descripcion);
                        $("#Detalle_Departamento").text(usuario.Dep_Descripcion);
                        $("#Detalle_Creacion").text(usuario.Creacion);

                        $("#Detalle_FechaCreacion").text(usuario.Cli_Fecha_Creacion);
                        $("#Detalle_Modifica").text(usuario.Modifica);
                        $("#Detalle_FechaModifica").text(usuario.Cli_Fecha_Modifica);
                        $("#tabla").hide();
                        $("#detalles").show();
                    }
                });
            });

            // Delegación de eventos para los botones de eliminar
            $('#example1 tbody').on('click', '.btn-danger', function() {
                const id = $(this).closest('tr').find('.abrir-editar').data('id');
                $('#modalEliminar').data('id', id).modal('show');
            });
        }

        attachClickEvents();

        table.on('draw', function() {
            attachClickEvents();
        });

        $("#btnNuevo").click(function() {
            $("#form-title").text('Nuevo Cliente');
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
            $("#insertar").show();
            $("#tabla").hide();
        });


        $("#Cancelar").click(function() {
            $("#insertar").hide();
            $("#tabla").show();
            document.querySelectorAll('.error-message').forEach(function(error) {
                error.textContent = '';
            });
            document.querySelectorAll('.form-control').forEach(function(input) {
                input.classList.remove('is-invalid');
            });
        });

        $("#btnGuardarUsuario").click(function() {
            if (validateForm()) {
                // const adminCheckbox = document.getElementById('Usu_Admin_checkbox');
                // const adminHiddenInput = document.getElementById('Usu_Admin');
                // adminHiddenInput.value = adminCheckbox.checked ? '1' : '0';
                $("#frmInsertar").submit();
            }
        });

        $("#btnVolver").click(function() {
            $("#detalles").hide();
            $("#tabla").show();
        });

        $("#btnConfirmarEliminar").click(function() {
            const id = $('#modalEliminar').data('id');
            $('#eliminarUsuarioId').val(id);
            $('#eliminarUsuarioForm').submit();
        });
    });
</script>