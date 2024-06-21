<?php
require_once '../Services/EmpleadoService.php';

$controller = new EmpleadoService();

// session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $nombre = $_POST['txtNombre'];
    $apellido = $_POST['txtApellido'];
    $FechaNacimiento = $_POST['txtFechaNacimiento'];
    $Sexo = $_POST['rbSexo'];
    $Identidad = $_POST['txtIdentidad'];
    $cargo  = $_POST['cargoSelect'];
    $sede = $_POST['sedeSelect'];
    $Ciudad = $_POST['ciudadSelect'];
    $Esciv = $_POST['estadoCivilSelect'];
    $Correo = $_POST['txtCorreo'];

    try {
        if ($id) {
            $Modifica = $_SESSION['ID'];
            $resultado = $controller->actualizar($id, $nombre, $apellido,$Sexo, $FechaNacimiento, $Ciudad, $Esciv,$cargo, $sede,  $Correo,  $Identidad, $Modifica);
        } else {
            $Creacion = $_SESSION['ID'];
            $resultado = $controller->insertar($nombre, $apellido, $Sexo,$FechaNacimiento, $Ciudad,$Esciv,$cargo, $sede, $Correo,  $Creacion, $Identidad);
        }

        if ($resultado == 1) {
            $_SESSION['mensaje'] = "Operación realizada correctamente.";
            $_SESSION['mensaje_tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Operación realizada correctamente.";
            $_SESSION['mensaje_tipo'] = "success";
        }
    } catch (Exception $e) {
        $_SESSION['mensaje'] = 'Error: ' . $e->getMessage();
        $_SESSION['mensaje_tipo'] = "error";
    }
}

try {
    $empleados = $controller->listarEmpleados();
    $estadosCiviles = $controller->listarEstadosCiviles();
    $cargos = $controller->listarCargo();
    $sedes = $controller->listarSede();
    $departamentos = $controller->listarDepartamentos();
} catch (Exception $e) {
    $mensajeError = 'Error al obtener datos: ' . $e->getMessage();
}

if (isset($mensajeError)) {
    echo '<div class="alert alert-danger">' . $mensajeError . '</div>';
}
?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
<div id="tabla">
    <div class="card">
        <div class="card-body">
            <h2 class="text-center" style="font-size:34px !important">Empleados</h2>

            <button class="btn btn-dark" id="btnNuevo">
                <i class="fa-solid fa-plus"></i>
                Nuevo
            </button>
            <hr>
            <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Identidad</th>
                        <th>Nombre Completo</th>
                        <th>Sexo</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Ciudad</th>
                        <th>Estado Civil</th>
                        <th>Cargo</th>
                        <th>Sede</th>
                        <th>Correo Electrónico</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($empleados as $empleado) : ?>
                        <tr>
                            <td><?php echo $empleado['Empl_Id']; ?></td>
                            <td><?php echo $empleado['Empl_DNI']; ?></td>
                            <td><?php echo $empleado['Empl_Nombre'] . ' ' . $empleado['Empl_Apellido']; ?></td>
                            <td><?php echo $empleado['Empl_Sexo']; ?></td>
                            <td><?php echo $empleado['Empl_FechaNac']; ?></td>
                            <td><?php echo $empleado['Ciu_Descripcion']; ?></td>
                            <td><?php echo $empleado['Est_Descripcion']; ?></td>
                            <td><?php echo $empleado['Crg_Descripcion']; ?></td>
                            <td><?php echo $empleado['Sed_Descripcion']; ?></td>
                            <td><?php echo $empleado['Empl_Correo']; ?></td>
                            <td class="d-flex justify-content-center" style="gap:10px">
                                <button style="color:white" class="btn btn-dark btn-sm abrir-editar" data-id="<?php echo $empleado['Empl_Id']; ?>"><i class="fas fa-edit"></i>Editar</button>
                                <button class="btn btn-secondary btn-sm btn-detalles" data-id="<?php echo $empleado['Empl_Id']; ?>"><i class="fas fa-eye"></i>Detalles</button>
                                <button class="btn btn-danger btn-sm" data-id="<?php echo $empleado['Empl_Id']; ?>"><i class="fas fa-trash"></i>Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="insertar" style="display:none;">
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title" id="form-title">Nuevo Empleado</h3>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cargo</label>
                            <select class="form-control select2" style="width: 100%;" id="cargoSelect" name="cargoSelect">
                                <option value="0">Seleccione</option>
                                <?php foreach ($cargos as $cargo) : ?>
                                    <option value="<?php echo $cargo['Crg_ID']; ?>"><?php echo $cargo['Crg_Descripcion']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span style="color:red" class="error-message" id="errorCargo"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sede</label>
                            <select class="form-control select2" style="width: 100%;" id="sedeSelect" name="sedeSelect">
                                <option value="0">Seleccione</option>
                                <?php foreach ($sedes as $sede) : ?>
                                    <option value="<?php echo $sede['Sed_ID']; ?>"><?php echo $sede['Sed_Descripcion']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span style="color:red" class="error-message" id="errorSede"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Correo Electrónico: </label>
                            <div class="input-group">
                                <input type="email" class="form-control " name="txtCorreo" id="txtCorreo">
                            </div>
                            <span style="color:red" class="error-message" id="errorCorreo"></span>
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

<!-- Detalles -->
<div id="detalles" style="display:none;">
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title" id="form-title">Detalle Empleado</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Código:</strong> <span id="Detalle_Codigo"></span></p>
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
                    <p><strong>Correo:</strong> <span id="Detalle_Correo"></span></p>
                </div>
                <div class="col-md-4">
                    <p><strong>Ciudad:</strong> <span id="Detalle_Ciudad"></span></p>
                    <p><strong>Departamento:</strong> <span id="Detalle_Departamento"></span></p>
                </div>
                <div class="col-md-4">
                    <p><strong>Cargo:</strong> <span id="Detalle_Cargo"></span></p>
                    <p><strong>Sede:</strong> <span id="Detalle_Sede"></span></p>
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

<form id="eliminarUsuarioForm" method="POST" action="../Services/empleado_eliminar.php" style="display:none;">
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

        const cargo = document.getElementById('cargoSelect');
        if (!cargo.value || cargo.value == '0') {
            document.getElementById('errorCargo').textContent = 'El campo es requerido';
            cargo.classList.add('is-invalid');
            isValid = false;
        }

        const sede = document.getElementById('sedeSelect');
        if (!sede.value || sede.value == '0') {
            document.getElementById('errorSede').textContent = 'El campo es requerido';
            sede.classList.add('is-invalid');
            isValid = false;
        }

        const correo = document.getElementById('txtCorreo');
        if (!correo.value) {
            document.getElementById('errorCorreo').textContent = 'El campo es requerido';
            correo.classList.add('is-invalid');
            isValid = false;
        }
        return isValid;
    }

    $(document).ready(function() {

        $("#EsquemaGeneral").addClass('menu-open');
        $("#LinkGeneral").addClass('active');
        $("#LinkItemGeneral").addClass('active');
        
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
            cargarCiudades(departamentoId);
        });

        var table = $("#example1").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
        });

        function attachClickEvents() {
            $(".abrir-editar").off('click').on('click', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: '../Services/empleado_obtener.php',
                    type: 'GET',
                    data: { id: id },
                    success: function(response) {
                        const empleado = JSON.parse(response);
                        $("#form-title").text('Editar Empleado');
                        $("#id").val(empleado.Empl_Id);
                        $("#txtNombre").val(empleado.Empl_Nombre);
                        $("#txtIdentidad").val(empleado.Empl_DNI);
                        $("#txtCorreo").val(empleado.Empl_Correo);
                        $("#txtApellido").val(empleado.Empl_Apellido);
                        $("#txtFechaNacimiento").val(empleado.Empl_FechaNac);
                        if (empleado.Empl_Sexo === "Femenino") {
                            $("#rbfemenino").prop("checked", true);
                        } else if (empleado.Empl_Sexo === "Masculino") {
                            $("#rbmasculino").prop("checked", true);
                        }
                        $("#estadoCivilSelect").val(empleado.Est_ID);
                        $("#departamentoSelect").val(empleado.Dep_ID);
                        $("#cargoSelect").val(empleado.Crg_ID);
                        $("#sedeSelect").val(empleado.Sed_ID);

                        cargarCiudades(empleado.Dep_ID, empleado.Ciu_Id);

                        $("#insertar").show();
                        $("#tabla").hide();
                    }
                });
            });

            $(".btn-detalles").off('click').on('click', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: '../Services/empleado_obtener.php',
                    type: 'GET',
                    data: { id: id },
                    success: function(response) {
                        const empleado = JSON.parse(response);

                        $("#Detalle_Codigo").text(id);
                        $("#Detalle_Nombre").text(empleado.Empl_Nombre);
                        $("#Detalle_Identidad").text(empleado.Empl_DNI);
                        $("#Detalle_Correo").text(empleado.Empl_Correo);
                        $("#Detalle_Apellido").text(empleado.Empl_Apellido);
                        $("#Detalle_FechaNacimiento").text(empleado.Empl_FechaNac);
                        $("#Detalle_Sexo").text(empleado.Empl_Sexo);
                        $("#Detalle_Ciudad").text(empleado.Ciu_Descripcion);
                        $("#Detalle_Esciv").text(empleado.Est_Descripcion);
                        $("#Detalle_Departamento").text(empleado.Dep_Descripcion);
                        $("#Detalle_Cargo").text(empleado.Crg_Descripcion);
                        $("#Detalle_Sede").text(empleado.Sed_Descripcion);
                        $("#Detalle_Creacion").text(empleado.UsuarioCreacion);

                        $("#Detalle_FechaCreacion").text(empleado.Empl_FechaCreacion);
                        $("#Detalle_Modifica").text(empleado.UsuarioModificacion);
                        $("#Detalle_FechaModifica").text(empleado.Empl_FechaModificacion);
                        $("#tabla").hide();
                        $("#detalles").show();
                    }
                });
            });

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
            $("#form-title").text('Nuevo Empleado');
            $("#id").val('');
            $("#txtNombre").val('');
            $("#txtApellido").val('');
            $("#txtIdentidad").val('');
            $("#txtCorreo").val('');
            $("#txtFechaNacimiento").val('');
            $("input[name='rbSexo']").prop("checked", false);
            $("#departamentoSelect").val('0');
            $("#ciudadSelect").val('0');
            $("#cargoSelect").val('0');
            $("#sedeSelect").val('0');
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

        <?php if (isset($_SESSION['mensaje'])): ?>
            iziToast.<?php echo $_SESSION['mensaje_tipo']; ?>({
                title: '<?php echo ucfirst($_SESSION['mensaje_tipo']); ?>',
                message: '<?php echo $_SESSION['mensaje']; ?>',
                position: 'topRight'
            });
            <?php unset($_SESSION['mensaje']); unset($_SESSION['mensaje_tipo']); ?>
        <?php endif; ?>
    });
</script>
