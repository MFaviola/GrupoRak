<?php
require_once '../Services/RolesService.php';
require_once '../Services/PantallaServices.php';

$controller = new RolesController();
$controller_2 = new  PantallasController();
// $controller_3 = new  PantallasController();
try {
    $clientes = $controller->listarRoles();
    $Pantallas = $controller_2->listarPantallas();
    // $PantallasPorRol = $controller_3->listarPantallasporRoles();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

?>
<div id="tabla">
<div class="card">
    <div class="card-body">
        <h2 class="text-center" style="font-size:34px !important">Roles</h2>

        <button class="btn btn-primary" id="btnNuevo">Nuevo</button>
        <hr>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Roles</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?php echo $cliente['Rol_Id']; ?></td>
                            <td><?php echo $cliente['Rol_Descripcion']; ?></td>
                            <td class="d-flex justify-content-center" style="gap:10px">
                            <a href="#" class="btn btn-warning btn-sm abrir-editar" data-id="<?php echo $cliente['Rol_Id']; ?>"><i class="fas fa-edit"></i> Editar</a>
                                <a href="#" class="btn btn-secondary btn-sm btn-detalles" data-id="<?php echo $cliente['Rol_Id']; ?>"><i class="fas fa-eye"></i> Detalles</a>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-eraser"></i> Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>
</div>
</div>


<div id="detalles" style="display:none;">
<div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title" id="form-title">Detalle de Rol</h3>
        </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Rol:</strong> <span id="Detalle_Usu_Usua"></span></p>
                <!-- <p><strong>Administrador:</strong> <span id="Detalle_Admin"></span></p> -->
            </div>
            <!-- <div class="col-md-6">
                <p><strong>Rol:</strong> <span id="Detalle_Rol_Descripcion"></span></p>
                <p><strong>Empleado:</strong> <span id="Detalle_Nombre_Completo"></span></p>
            </div> -->
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

<div id="insertar" style="display:none;">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-secondary btn-sm" id="btnVolver">Volver</button>
                </div>
                <h3 class="card-title" id="form-title">Crear Rol</h3>
                </div>
                <div class="card-body">
                    <form id="frmInsertar" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <form asp-action="Create">
                                <div asp-validation-summary="ModelOnly" class="text-danger"></div>
                                <div class="form-group">
                                    <label>ROL:</label>
                                    <input type="text" class="form-control" name="Rol_Descripcion" id="Rol_Descripcion" required>
                                    <span style="color:red" class="error-message" id="errorUsuario"></span>
                                </div>
                                <div style="text-align:end">
                                    <div class="form-group">
                                        <input type="submit" value="Crear" class="btn btn-outline-secondary btn-sm flex-grow-1" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pantalla" style="background-color:#fff; color: black;">
                            <table class="table" id="tbPant">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            Pantallas
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($Pantallas as $Pantalla): ?>
                                        <tr >
                                            <!-- <td class="dragitem btn btn-dark" data-id="@item.Pant_Id" style="width:100%">
                                                @item.Pant_Descripcion
                                            </td> -->
                                            <td><?php echo $Pantalla['Ptl_Descripcion']; ?></td>
                                        </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 pantallaPorRoles" style="background-color: #fff; color: black;">
                            <table class="table" id="tbPantRole">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            Pantallas Por Rol
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                <?php //foreach ($PantallasPorRol as $Pantallarol): ?>
                                        <!-- @Model.IDs_Pantallas.Add(item);
                                        <tr>
                                            <td class="dragitem ">
                                                @item.Pant_Descripcion
                                            </td>
                                        </tr> -->
                                        <td><?php// echo $Pantallarol['Ptl_Descripcion']; ?></td>
                                <?php //endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
            </div>
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
                ¿Estás seguro de que deseas eliminar este Rol?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnConfirmarEliminar">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- Formulario oculto para la eliminación del usuario -->
<form id="eliminarUsuarioForm" method="POST" action="../Services/eliminar_rol.php" style="display:none;">
    <input type="hidden" name="id" id="eliminarUsuarioId">
</form>




<!-- jQuery -->
<script src="../Views/Resources/plugins/jquery/jquery.min.js"></script>

<script>
$(document).ready(function() {
    // Inicialización de DataTables
    var table = $("#example1").DataTable({
        "responsive": false,
        "lengthChange": false,
        "autoWidth": false,
    });

    function attachClickEvents() {
        // $(".abrir-editar").off('click').on('click', function() {
        //     const id = $(this).data('id');
        //     $.ajax({
        //         url: '../Services/obtener_usuario.php',
        //         type: 'GET',
        //         data: { id: id },
        //         success: function(response) {
        //             const usuario = JSON.parse(response);
        //             $("#form-title").text('Editar Usuario');
        //             $("#id").val(usuario.Usu_ID);
        //             $("#Usu_Usua").val(usuario.Usu_Usua);
        //             $("#Usu_Contra").val('');
        //             $("#Usu_Admin_checkbox").prop('checked', usuario.Usu_Admin == 1);
        //             $("#Usu_Admin").val(usuario.Usu_Admin);
        //             $("#Rol_Id").val(usuario.Rol_Id);
        //             $("#Empl_Id").val(usuario.Empl_Id);
        //             $("#password-field").hide();
        //             $("#insertar").show();
        //             $("#tabla").hide();
        //         }
        //     });
        // });

        $(".btn-detalles").off('click').on('click', function() {
            const id = $(this).data('id');
            $.ajax({
                url: '../Services/obtener_usuario.php',
                type: 'GET',
                data: { id: id },
                success: function(response) {
                    const usuario = JSON.parse(response);
                    $("#Detalle_Usu_Usua").text(usuario.Rol_Descripcion);
                    // $("#Detalle_Admin").text(usuario.Usu_Admin == 1 ? 'Admin' : 'Usuario');
                    // $("#Detalle_Rol_Descripcion").text(usuario.Rol_Descripcion);
                    // $("#Detalle_Nombre_Completo").text(usuario.Nombre_Completo_2);
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