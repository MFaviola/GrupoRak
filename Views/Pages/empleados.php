<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Empleados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    
</head>
<body>
<div class="card">
    <div class="card-body">
        <h2 class="text-center" style="font-size:34px !important">Empleado</h2>
        <div class="CrearOcultar">
            <p class="btn btn-primary" id="AbrirModal"><i class="fa-solid fa-plus"></i> Nuevo</p>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-responsive" id="TablaEmpleado">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Sexo</th>
                            <th>Ciudad</th>
                            <th>Estado Civil</th>
                            <th>Sede</th>
                            <th>Cargo</th>
                            <th>DNI</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="TablaEmpleadoBody">
                    </tbody>
                </table>
            </div>
        </div>

        <div class="CrearMostrar" style="display: none;">
            <form id="frmEmpleado" method="POST">
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="control-label">Nombre</label>
                        <input name="Empl_Nombre" class="form-control" id="Empl_Nombre" />
                        <span class="text-danger" id="errorNombre"></span>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Apellido</label>
                        <input name="Empl_Apellido" class="form-control" id="Empl_Apellido" />
                        <span class="text-danger" id="errorApellido"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <label class="control-label">Sexo</label><br>
                        <input type="radio" name="Empl_Sexo" value="M" id="Empl_Sexo_M" /> Masculino
                        <input type="radio" name="Empl_Sexo" value="F" id="Empl_Sexo_F" /> Femenino
                        <span class="text-danger" id="errorSexo"></span>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label">Fecha Nacimiento</label>
                        <input name="Empl_FechaNac" class="form-control" id="Empl_FechaNac" type="date" />
                        <span class="text-danger" id="errorFechaNac"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ciudad:</label>
                            <select class="form-control" name="Ciu_Id" id="Ciu_Id">
                                <option value="">Seleccione una Ciudad</option>
                            </select>
                            <span class="text-danger" id="errorCiudad"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Estado Civil:</label>
                            <select class="form-control" name="Est_ID" id="Est_ID">
                                <option value="">Seleccione un Estado Civil</option>
                            </select>
                            <span class="text-danger" id="errorEstadoCivil"></span>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sede:</label>
                            <select class="form-control" name="Sed_ID" id="Sed_ID">
                                <option value="">Seleccione una Sede</option>
                            </select>
                            <span class="text-danger" id="errorSede"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cargo:</label>
                            <select class="form-control" name="Carg_Id" id="Carg_Id">
                                <option value="">Seleccione un Cargo</option>
                            </select>
                            <span class="text-danger" id="errorCargo"></span>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>DNI:</label>
                            <input name="Empl_DNI" class="form-control" id="Empl_DNI" />
                            <span class="text-danger" id="errorDNI"></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-row d-flex justify-content-end">
                   
                            <input type="submit" value="Guardar" class="btn btn-primary" id="guardarBtn" />
                       
                            <a id="CerrarModal" class="btn btn-secondary" style="color:white"><i class="fa-solid fa-arrow-left"></i> Volver</a>
                     
                    </div>
                </div>
            </form>
        </div>

        <div id="Detalles" style="display: none;">
            <div class="row" style="padding: 10px;">
                <div class="col" style="font-weight:700">ID</div>
                <div class="col" style="font-weight:700">Nombre</div>
                <div class="col" style="font-weight:700">Apellido</div>
                <div class="col" style="font-weight:700">Sexo</div>
                <div class="col" style="font-weight:700">Fecha Nacimiento</div>
                <div class="col" style="font-weight:700">Ciudad</div>
                <div class="col" style="font-weight:700">Estado Civil</div>
                <div class="col" style="font-weight:700">Sede</div>
                <div class="col" style="font-weight:700">Cargo</div>
                <div class="col" style="font-weight:700">DNI</div>
            </div>
            <div class="row" style="padding: 10px;">
                <div class="col"><label for="" id="DetallesId"></label></div>
                <div class="col"><label for="" id="DetallesNombre"></label></div>
                <div class="col"><label for="" id="DetallesApellido"></label></div>
                <div class="col"><label for="" id="DetallesSexo"></label></div>
                <div class="col"><label for="" id="DetallesFechaNac"></label></div>
                <div class="col"><label for="" id="DetallesCiudad"></label></div>
                <div class="col"><label for="" id="DetallesEstadoCivil"></label></div>
                <div class="col"><label for="" id="DetallesSede"></label></div>
                <div class="col"><label for="" id="DetallesCargo"></label></div>
                <div class="col"><label for="" id="DetallesDNI"></label></div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <h5>Auditoria</h5>
                    <hr>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Acciones</th>
                                <th>Usuario</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Insertar</td>
                                <td><label for="" id="DetallesUsuarioCreacion"></label></td>
                                <td><label for="" id="DetallesFechaCreacion"></label></td>
                            </tr>
                            <tr>
                                <td>Modificar</td>
                                <td><label for="" id="DetallesUsuarioModificacion"></label></td>
                                <td><label for="" id="DetallesFechaModificacion"></label></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col d-flex justify-content-end m-3">
                <a class="btn btn-secondary" style="color:white" id="VolverDetalles"><i class="fa-solid fa-arrow-left"></i> Cancelar</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal" id="eliminarModal" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="close" id="CerrarEliminarModal">&times;</button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este Empleado?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="CancelarEliminar"><i class="fa-solid fa-times"></i> Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmarEliminarBtn"><i class="fa-solid fa-trash"></i> Eliminar</button>
            </div>
        </div>
    </div>
</div>

<script src="Views/Resources/plugins/jquery/jquery.min.js"></script>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var AbrirModalBtn = document.getElementById('AbrirModal');
        var CerrarModalBtn = document.getElementById('CerrarModal');
        var guardarBtn = document.getElementById('guardarBtn');
        var VolverDetallesBtn = document.getElementById('VolverDetalles');
        var frmEmpleado = document.getElementById('frmEmpleado');
        var TablaEmpleadoBody = document.getElementById('TablaEmpleadoBody');
        var CrearOcultar = document.querySelector('.CrearOcultar');
        var CrearMostrar = document.querySelector('.CrearMostrar');
        var Detalles = document.getElementById('Detalles');
        var eliminarModal = document.getElementById('eliminarModal');
        var confirmarEliminarBtn = document.getElementById('confirmarEliminarBtn');
        var CerrarEliminarModal = document.getElementById('CerrarEliminarModal');
        var CancelarEliminar = document.getElementById('CancelarEliminar');

        AbrirModalBtn.addEventListener('click', function() {
            CrearOcultar.style.display = 'none';
            CrearMostrar.style.display = 'block';
            frmEmpleado.reset();
            sessionStorage.setItem('Empl_Id', "0");
        });

        CerrarModalBtn.addEventListener('click', function() {
            CrearOcultar.style.display = 'block';
            CrearMostrar.style.display = 'none';
        });

        VolverDetallesBtn.addEventListener('click', function() {
            Detalles.style.display = 'none';
            CrearOcultar.style.display = 'block';
        });

        CerrarEliminarModal.addEventListener('click', function() {
            eliminarModal.style.display = 'none';
        });

        CancelarEliminar.addEventListener('click', function() {
            eliminarModal.style.display = 'none';
        });

        function cargarEmpleados() {
            fetch('Services/EmpleadoService.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'action=listarEmpleados'
            })
            .then(response => response.json())
            .then(data => {
                TablaEmpleadoBody.innerHTML = '';
                data.data.forEach(empleado => {
                    var row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${empleado.Empl_Id}</td>
                        <td>${empleado.Empl_Nombre}</td>
                        <td>${empleado.Empl_Apellido}</td>
                        <td>${empleado.Empl_Sexo === 'M' ? 'Masculino' : 'Femenino'}</td>
                        <td>${empleado.Ciudad}</td>
                        <td>${empleado.EstadoCivil}</td>
                        <td>${empleado.Sede}</td>
                        <td>${empleado.Cargo}</td>
                        <td>${empleado.Empl_DNI}</td>
                        <td class="text-center">
                            <button class="btn btn-primary btn-sm abrir-editar" data-id="${empleado.Empl_Id}"><i class="fas fa-edit"></i> Editar</button>
                            <button class="btn btn-secondary btn-sm abrir-detalles" data-id="${empleado.Empl_Id}"><i class="fas fa-eye"></i> Detalles</button>
                            <button class="btn btn-danger btn-sm abrir-eliminar" data-id="${empleado.Empl_Id}"><i class="fas fa-trash"></i> Eliminar</button>
                        </td>
                    `;
                    TablaEmpleadoBody.appendChild(row);
                });

                document.querySelectorAll('.abrir-editar').forEach(button => {
                    button.addEventListener('click', function() {
                        var Empl_Id = this.getAttribute('data-id');
                        fetchEmpleadoPorId(Empl_Id, function(empleado) {
                            sessionStorage.setItem('Empl_Id', empleado.Empl_Id);
                            document.getElementById('Empl_Nombre').value = empleado.Empl_Nombre;
                            document.getElementById('Empl_Apellido').value = empleado.Empl_Apellido;

                            var sexoM = document.getElementById('Empl_Sexo_M');
                            var sexoF = document.getElementById('Empl_Sexo_F');

                            if (sexoM && sexoF) {
                                if (empleado.Empl_Sexo === 'M') {
                                    sexoM.checked = true;
                                } else if (empleado.Empl_Sexo === 'F') {
                                    sexoF.checked = true;
                                }
                            } else {
                                console.error('No se encontraron los elementos de entrada para el sexo.');
                            }

                            document.getElementById('Empl_FechaNac').value = empleado.Empl_FechaNac.split(' ')[0];
                            document.getElementById('Ciu_Id').value = empleado.Ciu_Id;
                            document.getElementById('Est_ID').value = empleado.Est_ID;
                            document.getElementById('Sed_ID').value = empleado.Sed_ID;
                            document.getElementById('Carg_Id').value = empleado.Carg_Id;
                            document.getElementById('Empl_DNI').value = empleado.Empl_DNI;
                            CrearOcultar.style.display = 'none';
                            CrearMostrar.style.display = 'block';
                        });
                    });
                });

                document.querySelectorAll('.abrir-detalles').forEach(button => {
                    button.addEventListener('click', function() {
                        var Empl_Id = this.getAttribute('data-id');
                        fetchEmpleadoPorId(Empl_Id, function(empleado) {
                            document.getElementById('DetallesId').textContent = empleado.Empl_Id;
                            document.getElementById('DetallesNombre').textContent = empleado.Empl_Nombre;
                            document.getElementById('DetallesApellido').textContent = empleado.Empl_Apellido;
                            document.getElementById('DetallesSexo').textContent = empleado.Empl_Sexo === 'M' ? 'Masculino' : 'Femenino';
                            document.getElementById('DetallesFechaNac').textContent = empleado.Empl_FechaNac;
                            document.getElementById('DetallesCiudad').textContent = empleado.Ciudad;
                            document.getElementById('DetallesEstadoCivil').textContent = empleado.EstadoCivil;
                            document.getElementById('DetallesSede').textContent = empleado.Sede;
                            document.getElementById('DetallesCargo').textContent = empleado.Cargo;
                            document.getElementById('DetallesDNI').textContent = empleado.Empl_DNI;
                            document.getElementById('DetallesUsuarioCreacion').textContent = empleado.UsuarioCreacion;
                            document.getElementById('DetallesUsuarioModificacion').textContent = empleado.UsuarioModificacion;
                            document.getElementById('DetallesFechaCreacion').textContent = empleado.Empl_FechaCreacion;
                            document.getElementById('DetallesFechaModificacion').textContent = empleado.Empl_FechaModificacion;
                            Detalles.style.display = 'block';
                            CrearOcultar.style.display = 'none';
                        });
                    });
                });

                document.querySelectorAll('.abrir-eliminar').forEach(button => {
                    button.addEventListener('click', function() {
                        var Empl_Id = this.getAttribute('data-id');
                        sessionStorage.setItem('Empl_Id', Empl_Id);
                        eliminarModal.style.display = 'block';
                    });
                });
            })
            .catch(error => console.error('Error al cargar los empleados.', error));
        }

        function fetchEmpleadoPorId(Empl_Id, callback) {
            fetch('Services/EmpleadoService.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `action=buscar&Empl_Id=${Empl_Id}`
            })
            .then(response => response.json())
            .then(data => {
                callback(data.data[0]);
            })
            .catch(error => console.error('Error al buscar el empleado.', error));
        }

        confirmarEliminarBtn.addEventListener('click', function() {
            var Empl_Id = sessionStorage.getItem('Empl_Id');
            fetch('Services/EmpleadoService.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `action=eliminar&Empl_Id=${Empl_Id}`
            })
            .then(response => response.text())
            
            .then(result => {
                if (result == 1) {
                    iziToast.success({
                        title: 'Éxito',
                        message: 'Eliminado con éxito',
                        position: 'topRight'
                    });
                    cargarEmpleados();
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: 'Error al eliminar empleado',
                        position: 'topRight'
                    });
                }
                eliminarModal.style.display = 'none';
            })
            .catch(error => {
                iziToast.error({
                    title: 'Error',
                    message: 'Error en la comunicación con el servidor',
                    position: 'topRight'
                });
                console.error('Error en la comunicación con el servidor.', error);
                eliminarModal.style.display = 'none';
            });
        });

        frmEmpleado.addEventListener('submit', function(event) {
            event.preventDefault(); 
            
            let isValid = true;

            document.querySelectorAll('.text-danger').forEach(function(error) {
                error.textContent = '';
            });

            const nombre = document.getElementById('Empl_Nombre');
            if (!nombre.value.trim()) {
                document.getElementById('errorNombre').textContent = 'El campo es requerido';
                nombre.classList.add('is-invalid');
                isValid = false;
            } else {
                nombre.classList.remove('is-invalid');
            }

            const apellido = document.getElementById('Empl_Apellido');
            if (!apellido.value.trim()) {
                document.getElementById('errorApellido').textContent = 'El campo es requerido';
                apellido.classList.add('is-invalid');
                isValid = false;
            } else {
                apellido.classList.remove('is-invalid');
            }

            const sexoM = document.getElementById('Empl_Sexo_M');
            const sexoF = document.getElementById('Empl_Sexo_F');
            if (!sexoM.checked && !sexoF.checked) {
                document.getElementById('errorSexo').textContent = 'El campo es requerido';
                sexoM.classList.add('is-invalid');
                sexoF.classList.add('is-invalid');
                isValid = false;
            } else {
                sexoM.classList.remove('is-invalid');
                sexoF.classList.remove('is-invalid');
            }

            const fechaNac = document.getElementById('Empl_FechaNac');
            if (!fechaNac.value.trim()) {
                document.getElementById('errorFechaNac').textContent = 'El campo es requerido';
                fechaNac.classList.add('is-invalid');
                isValid = false;
            } else {
                fechaNac.classList.remove('is-invalid');
            }

            const ciudad = document.getElementById('Ciu_Id');
            if (!ciudad.value.trim()) {
                document.getElementById('errorCiudad').textContent = 'El campo es requerido';
                ciudad.classList.add('is-invalid');
                isValid = false;
            } else {
                ciudad.classList.remove('is-invalid');
            }

            const estadoCivil = document.getElementById('Est_ID');
            if (!estadoCivil.value.trim()) {
                document.getElementById('errorEstadoCivil').textContent = 'El campo es requerido';
                estadoCivil.classList.add('is-invalid');
                isValid = false;
            } else {
                estadoCivil.classList.remove('is-invalid');
            }

            const sede = document.getElementById('Sed_ID');
            if (!sede.value.trim()) {
                document.getElementById('errorSede').textContent = 'El campo es requerido';
                sede.classList.add('is-invalid');
                isValid = false;
            } else {
                sede.classList.remove('is-invalid');
            }

            const cargo = document.getElementById('Carg_Id');
            if (!cargo.value.trim()) {
                document.getElementById('errorCargo').textContent = 'El campo es requerido';
                cargo.classList.add('is-invalid');
                isValid = false;
            } else {
                cargo.classList.remove('is-invalid');
            }

            const dni = document.getElementById('Empl_DNI');
            if (!dni.value.trim()) {
                document.getElementById('errorDNI').textContent = 'El campo es requerido';
                dni.classList.add('is-invalid');
                isValid = false;
            } else {
                dni.classList.remove('is-invalid');
            }

            if (isValid) {
                guardarEmpleado();
            }
        });

        function guardarEmpleado() {
            var Empl_Id = sessionStorage.getItem('Empl_Id');
            var Empl_Nombre = document.getElementById('Empl_Nombre').value;
            var Empl_Apellido = document.getElementById('Empl_Apellido').value;
            var Empl_Sexo = document.querySelector('input[name="Empl_Sexo"]:checked') ? document.querySelector('input[name="Empl_Sexo"]:checked').value : '';
            var Empl_FechaNac = document.getElementById('Empl_FechaNac').value;
            var Ciu_Id = document.getElementById('Ciu_Id').value;
            var Est_ID = document.getElementById('Est_ID').value;
            var Sed_ID = document.getElementById('Sed_ID').value;
            var Carg_Id = document.getElementById('Carg_Id').value;
            var Empl_DNI = document.getElementById('Empl_DNI').value;

            console.log("Datos enviados:", {
                Empl_Id,
                Empl_Nombre,
                Empl_Apellido,
                Empl_Sexo,
                Empl_FechaNac,
                Ciu_Id,
                Est_ID,
                Sed_ID,
                Carg_Id,
                Empl_DNI
            });

            var action = Empl_Id == "0" ? 'insertar' : 'actualizar';
            var requestData = `action=${action}&Empl_Id=${Empl_Id}&Empl_Nombre=${Empl_Nombre}&Empl_Apellido=${Empl_Apellido}&Empl_Sexo=${Empl_Sexo}&Empl_FechaNac=${Empl_FechaNac}&Ciu_Id=${Ciu_Id}&Est_ID=${Est_ID}&Sed_ID=${Sed_ID}&Carg_Id=${Carg_Id}&Empl_DNI=${Empl_DNI}`;

            fetch('Services/EmpleadoService.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: requestData
            })
            .then(response => response.text())
            
            .then(result => {
                console.log('Respuesta del servidor:', result);

                if (result == 1) {
                    iziToast.success({
                        title: 'Éxito',
                        message: 'Guardado con éxito',
                        position: 'topRight'
                    });
                    frmEmpleado.reset();
                    cargarEmpleados();
                    CrearOcultar.style.display = 'block';
                    CrearMostrar.style.display = 'none';
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: 'No se pudo guardar',
                        position: 'topRight'
                    });
                }
            })
            .catch(error => {
                iziToast.error({
                    title: 'Error',
                    message: 'Error en la comunicación con el servidor',
                    position: 'topRight'
                });
                console.error('Error en la comunicación con el servidor.', error);
            });
        }

        function cargarOpcionesDDL() {
            cargarOpciones('sp_Ciudad_Listar', 'Ciu_Id', 'Ciu_ID', 'Ciu_Descripcion');
            cargarOpciones('sp_EstadoCivil_Listar', 'Est_ID', 'Est_ID', 'Est_Descripcion');
            cargarOpciones('sp_Sedes_Listar', 'Sed_ID', 'Sed_ID', 'Sed_Descripcion');
            cargarOpciones('sp_Cargo_Listar', 'Carg_Id', 'Crg_ID', 'Crg_Descripcion');
        }

        function cargarOpciones(procedimiento, selectId, idCampo, descripcionCampo) {
            fetch('Services/EmpleadoService.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `action=${procedimiento}`
            })
            .then(response => response.json())
            .then(data => {
                var select = document.getElementById(selectId);
                if (select) {
                    select.innerHTML = '<option value="">Seleccione una opción</option>';
                    
                    if (data && data.data) {
                        data.data.forEach(item => {
                            var option = document.createElement('option');
                            option.value = item[idCampo];
                            option.text = item[descripcionCampo];
                            select.appendChild(option);
                        });
                    } else {
                        console.error(`No se recibieron datos válidos para ${selectId}.`, data);
                    }
                } else {
                    console.error(`No se encontró el elemento select con ID ${selectId}.`);
                }
            })
            .catch(error => console.error(`Error al cargar opciones para ${selectId}.`, error));
        }

        cargarEmpleados();
        cargarOpcionesDDL();
    });

    // Configuración de DataTables
    $(document).ready(function() {
        $('#TablaEmpleado').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            // buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            language: {
                search: "Buscar:",
                paginate: {
                    next: "Siguiente",
                    previous: "Anterior"
                }
            }
        }).buttons().container().appendTo('#TablaEmpleado_wrapper .col-md-6:eq(0)');

        // Reubicar los botones de DataTables en una línea
        var buttonContainer = $('#TablaEmpleado_wrapper .col-md-6:eq(0)');
        buttonContainer.css('display', 'flex');
        buttonContainer.css('flex-direction', 'row');
        buttonContainer.css('justify-content', 'center');
        buttonContainer.css('gap', '10px');
    });
</script>

</body>
</html>
