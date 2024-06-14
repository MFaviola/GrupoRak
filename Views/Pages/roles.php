<?php
require_once 'Controllers/RolesController.php';

$controller = new RolesController();
try {
    $clientes = $controller->listarRoles();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

?>

<div class="card">
    <div class="card-body">
        <h2 class="text-center" style="font-size:34px !important">Roles</h2>

        <p class="btn btn-primary" id="AbrirModal">
            Nuevo
        </p>
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
                            <td><?php echo $cliente['Codigo']; ?></td>
                            <td><?php echo $cliente['Rol_Descripcion']; ?></td>
                            <td class="d-flex justify-content-center" style="gap:10px">
                                <a  style="color:white" class="btn btn-warning btn-sm abrir-editar"><i class="fas fa-edit"></i>Editar</a>
                                <a  class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i>Detalles</a>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-eraser"></i> Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </div>
</div>



<!-- jQuery -->
<script src="Views/Resources/plugins/jquery/jquery.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": false,
    });
  });
</script>