<?php
require_once '../Services/DashboardsService.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new DashboardsServices();

    try {
        $reporte = $controller->cantidadVentasMes();
        echo json_encode($reporte);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>