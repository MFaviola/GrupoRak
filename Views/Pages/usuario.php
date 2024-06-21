<?php
require_once '../Services/UsuarioService.php';
require_once '../Services/RolesService.php';
// require_once '../Services/EmpleadoService.php';

$controller = new UsuarioController();
$rolesController = new RolesController();
$empleadoController = new UsuarioController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $usuario = $_POST['Usu_Usua'];
    $contra = isset($_POST['Usu_Contra']) ? $_POST['Usu_Contra'] : null;
    $admin = $_POST['Usu_Admin'];
    $rolId = $_POST['Rol_Id'];
    $emplId = $_POST['Empl_Id'];

    try {
        if ($id) {
            $usu_id_modi = $_SESSION['ID'];
            $resultado = $controller->actualizarUsuario($id, $usuario, $admin, $rolId, $emplId, $usu_id_modi);
        } else {
            $resultado = $controller->insertarUsuario($usuario, $contra, $admin, $rolId, $emplId);
        }
        //echo '<div class="alert alert-success">' . $resultado . '</div>';
    } catch (Exception $e) {
        //echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
    }
}

try {
    $clientes = $controller->listarUsuario();
    $roles = $rolesController->listarRoles();
    $empleados = $empleadoController->listarempleados();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<div id="tabla">
    <div class="card">
        <div class="card-body">
            <h2 class="text-center" style="font-size:34px !important">Usuarios</h2>
            <button class="btn btn-dark" id="btnNuevo">
                <i class="fa-solid fa-plus"></i>
                Nuevo
            </button>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Usuario</th>
                        <th>Administrador</th>
                        <th>Rol</th>
                        <th>Empleado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente) : ?>
                        <tr>
                            <td><?php echo $cliente['Usu_ID']; ?></td>
                            <td><?php echo $cliente['Usu_Usua']; ?></td>
                            <td><?php echo $cliente['Admin']; ?></td>
                            <td><?php echo $cliente['Rol_Descripcion']; ?></td>
                            <td><?php echo $cliente['Empl_Nombre_Completo']; ?></td>
                            <td class="d-flex justify-content-center" style="gap:10px">
                                <a href="#" class="btn btn-dark btn-sm abrir-editar" data-id="<?php echo $cliente['Usu_ID']; ?>"><i class="fas fa-edit"></i> Editar</a>
                                <a href="#" class="btn btn-secondary btn-sm btn-detalles" data-id="<?php echo $cliente['Usu_ID']; ?>"><i class="fas fa-eye"></i> Detalles</a>
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
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title" id="form-title">Crear Nuevo Usuario</h3>
        </div>
        <div class="card-body">
            <form id="frmInsertar" method="POST">
                <input type="hidden" name="id" id="id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Usuario:</label>
                            <input type="text" class="form-control" name="Usu_Usua" id="Usu_Usua" required>
                            <span style="color:red" class="error-message" id="errorUsuario"></span>
                        </div>
                    </div>
                    <div class="col-md-6" id="password-field">
                        <div class="form-group">
                            <label>Contraseña:</label>
                            <input type="text" class="form-control" name="Usu_Contra" id="Usu_Contra">
                            <span style="color:red" class="error-message" id="errorContraseña"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Rol:</label>
                            <select class="form-control" name="Rol_Id" id="Rol_Id" required>
                                <option value="">--Seleccione un Rol--</option>
                                <?php foreach ($roles as $rol) : ?>
                                    <option value="<?php echo $rol['Rol_Id']; ?>"><?php echo $rol['Rol_Descripcion']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span style="color:red" class="error-message" id="errorRol"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Empleado:</label>
                            <select class="form-control" id="Empl_Id" name="Empl_Id" required>
                                <option value="">--Seleccione un empleado--</option>
                                <?php foreach ($empleados as $empleado) : ?>
                                    <option value="<?php echo $empleado['Empl_Id']; ?>"><?php echo $empleado['Empl_Nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span style="color:red" class="error-message" id="errorEmpleado"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Administrador:</label>
                            <input type="checkbox" id="Usu_Admin_checkbox">
                            <input type="hidden" name="Usu_Admin" id="Usu_Admin" value="0">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end" style="gap:10px">
                        <button type="button" class="btn btn-dark" id="btnGuardarUsuario"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                        <button type="button" id="Cancelar" class="btn btn-secondary"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="detalles" style="display:none;">
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title" id="form-title">Detalle de Usuario</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Usuario:</strong> <span id="Detalle_Usu_Usua"></span></p>
                    <p><strong>Administrador:</strong> <span id="Detalle_Admin"></span></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Rol:</strong> <span id="Detalle_Rol_Descripcion"></span></p>
                    <p><strong>Empleado:</strong> <span id="Detalle_Nombre_Completo"></span></p>
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
                ¿Estás seguro de que deseas eliminar este usuario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-xmark"></i> Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnConfirmarEliminar"><i class="fa-solid fa-trash"></i> Eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- Formulario oculto para la eliminación del usuario -->
<form id="eliminarUsuarioForm" method="POST" action="../Services/eliminar_usuario.php" style="display:none;">
    <input type="hidden" name="id" id="eliminarUsuarioId">
</form>





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

        const usuario = document.getElementById('Usu_Usua');
        if (!usuario.value) {
            document.getElementById('errorUsuario').textContent = 'El campo es requerido';
            usuario.classList.add('is-invalid');
            isValid = false;
        }

        const contraseña = document.getElementById('Usu_Contra');
        if (!contraseña.value && document.getElementById('password-field').style.display !== 'none') {
            document.getElementById('errorContraseña').textContent = 'El campo es requerido';
            contraseña.classList.add('is-invalid');
            isValid = false;
        }

        const rol = document.getElementById('Rol_Id');
        if (!rol.value) {
            document.getElementById('errorRol').textContent = 'El campo es requerido';
            rol.classList.add('is-invalid');
            isValid = false;
        }

        const empleado = document.getElementById('Empl_Id');
        if (!empleado.value) {
            document.getElementById('errorEmpleado').textContent = 'El campo es requerido';
            empleado.classList.add('is-invalid');
            isValid = false;
        }

        return isValid;
    }

    $(document).ready(function() {
   

        $("#EsquemaAcceso").addClass('menu-open');
        $("#LinkAcceso").addClass('active');
        $("#usuario").addClass('active');
        var clienteactivo = $("#cliente").text();

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
                    url: '../Services/obtener_usuario.php',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        const usuario = JSON.parse(response);
                        $("#form-title").text('Editar Usuario');
                        $("#id").val(usuario.Usu_ID);
                        $("#Usu_Usua").val(usuario.Usu_Usua);
                        $("#Usu_Contra").val('');
                        $("#Usu_Admin_checkbox").prop('checked', usuario.Usu_Admin == 1);
                        $("#Usu_Admin").val(usuario.Usu_Admin);
                        $("#Rol_Id").val(usuario.Rol_Id);
                        $("#Empl_Id").val(usuario.Empl_Id);
                        $("#password-field").hide();
                        $("#insertar").show();
                        $("#tabla").hide();
                    }
                });
            });

            $(".btn-detalles").off('click').on('click', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: '../Services/obtener_usuario.php',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        const usuario = JSON.parse(response);
                        $("#Detalle_Usu_Usua").text(usuario.Usu_Usua);
                        $("#Detalle_Admin").text(usuario.Usu_Admin == 1 ? 'Admin' : 'Usuario');
                        $("#Detalle_Rol_Descripcion").text(usuario.Rol_Descripcion);
                        $("#Detalle_Nombre_Completo").text(usuario.Nombre_Completo_2);
                        $("#Detalle_Usuario_Creador").text(usuario.Usuario_Creador);
                        $("#Detalle_Usu_Fecha_Creacion").text(usuario.Usu_Fecha_Creacion);
                        $("#Detalle_Usuario_Modificador").text(usuario.Usuario_Modificador);
                        $("#Detalle_Usu_Fecha_Modifica").text(usuario.Usu_Fecha_Modifica);

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
            $("#Usu_Usua").val('');
            $("#Usu_Contra").val('');
            $("#Usu_Admin_checkbox").prop('checked', false);
            $("#Usu_Admin").val('0');
            $("#Rol_Id").val('');
            $("#Empl_Id").val('');
            $("#password-field").show();
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
                const adminCheckbox = document.getElementById('Usu_Admin_checkbox');
                const adminHiddenInput = document.getElementById('Usu_Admin');
                adminHiddenInput.value = adminCheckbox.checked ? '1' : '0';
                $("#frmInsertar").submit();
                localStorage.setItem('operacionExitosa', 'true');
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
            localStorage.setItem('operacionExitosa', 'true');
        });
    });
</script>