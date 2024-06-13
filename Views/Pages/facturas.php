<?php
require_once 'Controllers/FacturaController.php';

$controller = new FacturaController();
try {
    $facturas = $controller->listarFacturas();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

?>



<div class="card">
    <div class="card-body">
        <h2 class="text-center" style="font-size:34px !important">Facturas</h2>

        <p class="btn btn-primary" id="AbrirModal">
            Nuevo
        </p>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tablaOne">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Empleado</th>
                        <th>Método de Pago</th>
                        <th>Finalizado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($facturas as $factura): ?>
                        <tr>
                            <td><?php echo $factura['Fact_Id']; ?></td>
                            <td><?php echo $factura['Clie_Nombre']; ?></td>
                            <td><?php echo $factura['Empl_Nombre']; ?></td>
                            <td><?php echo $factura['Mepa_Metodo']; ?></td>
                            <td><?php echo $factura['Fact_Finalizado']; ?></td>
                            <td class="d-flex justify-content-center" style="gap:10px">
                                <a class="btn btn-primary btn-sm abrir-editar"><i class="fas fa-edit"></i>Editar</a>
                                <a class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i>Detalles</a>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-eraser"></i> Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>