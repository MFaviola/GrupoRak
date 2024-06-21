<?php
require_once '../Services/DashboardsService.php';

header('Content-Type: application/json');

if (isset($_GET['fecha_inicio'], $_GET['fecha_fin'])) {
    $fecha_inicio = $_GET['fecha_inicio'];
    $fecha_fin = $_GET['fecha_fin'];
    $controller = new DashboardsServices();
    $response = array();
    

    try {
        $response['cantidadComprasFiltro'] = $controller->cantidadComprasFiltro($fecha_inicio, $fecha_fin);
        $response['cantidadVentasFiltro'] = $controller->cantidadVentasFiltro($fecha_inicio, $fecha_fin);
        $response['cantidadVentasEmpleadosFiltro'] = $controller->cantidadVentasEmpleadosFiltro($fecha_inicio, $fecha_fin);
        $response['cantidadComprasClientesFiltro'] = $controller->cantidadComprasClientesFiltro($fecha_inicio, $fecha_fin);

       
    } catch (Exception $e) {
        $response['error'] = $e->getMessage();
    }

    echo json_encode($response);
    exit();
} else {
    echo json_encode(['error' => 'Faltan parámetros de fecha.']);
    exit();
}
