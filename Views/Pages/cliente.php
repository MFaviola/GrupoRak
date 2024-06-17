<?php
require_once 'Services/ClienteService.php';

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
            // $usu_id_modi = $_SESSION['ID'];
            $Modifica = 1;
            $resultado = $controller->actualizar($id, $nombre, $apellido, $FechaNacimiento, $Sexo, $Identidad,$Ciudad,$Esciv,$Direccion,$Modifica);
        } else {
            $Creacion = 1;
            $resultado = $controller->insertar($nombre, $apellido, $FechaNacimiento, $Sexo, $Identidad,$Ciudad,$Esciv,$Direccion,$Creacion);
        }
        //echo '<div class="alert alert-success">' . $resultado . '</div>';
    } catch (Exception $e) {
        //echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
    }
}

try {
    $clientes = $controller->listarClientes();
    $estadosCiviles = $controller->listarEstadosCiviles();
    $ciudades = $controller->listarCiudades();
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
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Sexo</th>
                        <th>Fecha Nacimiento</th>
                        <th>Sexo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente) : ?>
                        <tr>
                            <td><?php echo $cliente['Cli_Id']; ?></td>
                            <td><?php echo $cliente['Cli_DNI']; ?></td>
                            <td><?php echo $cliente['Cli_Nombre']; ?></td>
                            <td><?php echo $cliente['Cli_Apellido']; ?></td>
                            <td><?php echo $cliente['Cli_Sexo']; ?></td>
                            <td><?php echo $cliente['Cli_FechaNac']; ?></td>
                            <td><?php echo $cliente['Cli_Sexo']; ?></td>
                            <td class="d-flex justify-content-center" style="gap:10px">

                                <button style="color:white" class="btn btn-warning btn-sm abrir-editar" data-id="<?php echo $cliente['Cli_Id']; ?>"><i class="fas fa-edit"></i>Editar</button>
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
            <h3 class="card-title" id="form-title">Crear Nuevo Usuario</h3>
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
                                <input value="F" class="form-check-input" type="radio" name="rbSexo" id="rbfemenino" checked/>
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
                            <label>Ciudad</label>
                            <select class="form-control select2" style="width: 100%;" id="ciudadSelect" name="ciudadSelect">
                                <?php foreach ($ciudades as $ciudad) : ?>
                                    <option value="<?php echo $ciudad['Ciu_ID']; ?>"><?php echo $ciudad['Ciu_Descripcion']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span style="color:red" class="error-message" id="errorCiudad"></span>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Estado Civil</label>
                            <select class="form-control select2" style="width: 100%;" id="estadoCivilSelect" name="estadoCivilSelect">
                                <?php foreach ($estadosCiviles as $estadoCivil) : ?>
                                    <option value="<?php echo $estadoCivil['Est_ID']; ?>"><?php echo $estadoCivil['Est_Descripcion']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span style="color:red" class="error-message" id="errorEsciv"></span>
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
                        <button type="button" class="btn btn-primary" id="btnGuardarUsuario">Guardar Usuario</button>
                        <button type="button" id="Cancelar" class="btn btn-secondary">Cancelar</button>
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
            <h3 class="card-title" id="form-title">Detalle de Usuario</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nombre:</strong> <span id="Detalle_Nombre"></span></p>
                    <p><strong>Apellido:</strong> <span id="Detalle_Apellido"></span></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Identidad:</strong> <span id="Detalle_Identidad"></span></p>
                    <p><strong>Estado Civil:</strong> <span id="Detalle_Esciv"></span></p>
                </div>
            </div>
            <hr>
            <table class="table">
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
                        <td id="Detalle_Usuario_Creador"></td>
                        <td id="Detalle_Usu_Fecha_Creacion"></td>
                    </tr>
                    <tr>
                        <td>Modificado por</td>
                        <td id="Detalle_Usuario_Modificador"></td>
                        <td id="Detalle_Usu_Fecha_Modifica"></td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <button class="btn btn-secondary btn-sm" id="btnVolver">Volver</button>
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
                ¿Estás seguro de que deseas eliminar este usuario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnConfirmarEliminar">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- Formulario oculto para la eliminación del usuario -->
<form id="eliminarUsuarioForm" method="POST" action="Services/cliente_eliminar.php" style="display:none;">
    <input type="hidden" name="id" id="eliminarUsuarioId">
</form>

<!-- jQuery -->
<script src="Views/Resources/plugins/jquery/jquery.min.js"></script>

<!-- <script>
    function validateForm() {
        let isValid = true;

        // Clear previous error messages and remove is-invalid class
        document.querySelectorAll('.error-message').forEach(function(error) {
            error.textContent = '';
        });
        document.querySelectorAll('.form-control, .form-check-input').forEach(function(input) {
            input.classList.remove('is-invalid');
        });

        // Validate Identidad
        const identidad = document.getElementById('txtIdentidad');
        if (!identidad.value) {
            document.getElementById('errorIdentidad').textContent = 'El campo es requerido';
            identidad.classList.add('is-invalid');
            isValid = false;
        }

        // Validate Nombre
        const nombre = document.getElementById('txtNombre');
        if (!nombre.value) {
            document.getElementById('errorNombre').textContent = 'El campo es requerido';
            nombre.classList.add('is-invalid');
            isValid = false;
        }

        // Validate Apellido
        const apellido = document.getElementById('txtApellido');
        if (!apellido.value) {
            document.getElementById('errorApellido').textContent = 'El campo es requerido';
            apellido.classList.add('is-invalid');
            isValid = false;
        }

        // Validate Sexo
        const sexoF = document.getElementById('rbfemenino');
        const sexoM = document.getElementById('rbmasculino');
        if (!sexoF.checked && !sexoM.checked) {
            document.getElementById('errorSexo').textContent = 'El campo es requerido';
            sexoF.classList.add('is-invalid');
            sexoM.classList.add('is-invalid');
            isValid = false;
        }

        // Validate Direccion
        const direccion = document.getElementById('txtDireccion');
        if (!direccion.value) {
            document.getElementById('errorDireccion').textContent = 'El campo es requerido';
            direccion.classList.add('is-invalid');
            isValid = false;
        }

        return isValid;
    }

    $(function() {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    $(document).ready(function() {
        $("#insertar").hide();
    });

    $("#btnNuevo").click(function() {
        $("#insertar").show();
        $("#tabla").hide();
    });

    $("#regresar").click(function() {
        $("#insertar").hide();
        $("#tabla").show();
    });
</script> -->


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

        // const sexo = document.getElementById('rbSexo');
        // if (!sexo.value) {
        //     document.getElementById('errorSexo').textContent = 'El campo es requerido';
        //     sexo.classList.add('is-invalid');
        //     isValid = false;
        // }

        const fecha = document.getElementById('txtFechaNacimiento');
        if (!fecha.value) {
            document.getElementById('errorFecha').textContent = 'El campo es requerido';
            fecha.classList.add('is-invalid');
            isValid = false;
        }

        const ciudad = document.getElementById('ciudadSelect');
        if (!ciudad.value) {
            document.getElementById('errorCiudad').textContent = 'El campo es requerido';
            ciudad.classList.add('is-invalid');
            isValid = false;
        }

        const esciv = document.getElementById('estadoCivilSelect');
        if (!esciv.value) {
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
                    url: '/xampp/htdocs/GrupoRak/Services/cliente_obtener.php',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        const usuario = JSON.parse(response);
                        console.log("DATOS EDTIAR: " + usuario)
                        $("#form-title").text('Editar Usuario');
                        $("#id").val(usuario.Cli_Id);
                        $("#txtNombre").val(usuario.Cli_Nombre);
                        $("#txtIdentidad").val(usuario.Cli_DNI);
                        $("#txtDireccion").val(usuario.Cli_Direccion);
                        $("#txtApellido").val(usuario.Cli_Apellido);
                        $("#txtFechaNacimiento").val(usuario.Cli_FechaNac);
                        $("#rbSexo").val(usuario.Cli_Sexo);
                        $("#ciudadSelect").val(usuario.Ciu_Id);
                        $("#estadoCivilSelect").val(usuario.Est_ID);
    
                        $("#insertar").show();
                        $("#tabla").hide();
                    }
                });
            });

            $(".btn-detalles").off('click').on('click', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: 'Services/cliente_obtener.php',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        const usuario = JSON.parse(response);
                        console.log("DATOS Detalles: " + usuario)
                        $("#Detalle_Nombre").val(usuario.Cli_Nombre);
                        $("#Detalle_Identidad").val(usuario.Cli_DNI);
                        $("#Detalle_Direccion").val(usuario.Cli_Direccion);
                        $("#Detalle_Apellido").val(usuario.Cli_Apellido);
                        $("#Detalle_FechaNacimiento").val(usuario.Cli_FechaNac);
                        $("#Detalle_Sexo").val(usuario.Cli_Sexo);
                        $("#Detalle_Ciudad").val(usuario.Ciu_Id);
                        $("#Detalle_Esciv").val(usuario.Est_ID);
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
            $("#form-title").text('Crear Nuevo Usuario');
            $("#id").val('');
            $("#txtNombre").val('');
            $("#txtApellido").val('');
            $("#txtIdentidad").val('');
            $("#txtDireccion").val('');
            $("#txtFechaNacimiento").val('');
            $("#rbSexo").val('');
            $("#ciudadSelect").val('');
            $("#estadoCivilSelect").val('');
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