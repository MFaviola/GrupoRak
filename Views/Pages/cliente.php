<?php
require_once 'Services/ClienteService.php';

$controller = new ClienteService();
try {
    $clientes = $controller->listarClientes();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identidad = $_POST['txtIdentidad'];
    $nombre = $_POST['txtNombre'];
    $apellido = $_POST['txtApellido'];
    $sexo = $_POST['rbSexo'];
    $direccion = $_POST['txtDireccion'];

    // Convert identidad to DNI format if necessary
    $dni = $identidad; // Adjust this as needed to match your DNI format

    // Dummy date for demonstration purposes. Replace with actual date input.
    $fechaNac = '1990-01-01';

    $clienteService = new ClienteService();

    try {
        $clienteService->insertarCliente($nombre, $apellido, $fechaNac, $sexo, $dni, $direccion);
        // echo "Cliente insertado correctamente.";
    } catch (Exception $e) {
        // echo "Error al insertar cliente: " . $e->getMessage();
    }
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

                                <button style="color:white" class="btn btn-warning btn-sm "><i class="fas fa-edit"></i>Editar</button>
                                <button class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i>Detalles</button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-eraser"></i> Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="insertar">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Crear Nuevo Cliente</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form id="frmInsertar" method="POST" onsubmit="return validateForm()">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Identidad: </label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="txtIdentidad" id="txtIdentidad">
                            </div>
                            <span style="color:red" class="error-message" id="errorIdentidad"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre: </label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="txtNombre" id="txtNombre">
                            </div>
                            <span style="color:red" class="error-message" id="errorNombre"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Apellido: </label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="txtApellido" id="txtApellido">
                            </div>
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
            </form>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end" style="gap:10px">
                <button type="submit" form="frmInsertar" style="color:white" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                <button id="regresar" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Regresar</button>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<!-- /.card -->

</div>

<!-- jQuery -->
<script src="Views/Resources/plugins/jquery/jquery.min.js"></script>

<script>
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

    $(function() {
        $.validator.setDefaults({
            submitHandler: function() {
                alert("Form successful submitted!");
            }
        });
        $('#quickForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 5
                },
                terms: {
                    required: true
                },
            },
            messages: {
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                terms: "Please accept our terms"
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>