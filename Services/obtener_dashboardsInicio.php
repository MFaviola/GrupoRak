<?php
require_once '../Services/DashboardsService.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new DashboardsServices();
    $response = array();

    try {
        $response['ventasMes'] = $controller->cantidadVentasMes();
    } catch (Exception $e) {
        $response['ventasMes'] = ['error' => $e->getMessage()];
    }

    try {
        $response['comprasMes'] = $controller->cantidadComprasMes();
    } catch (Exception $e) {
        $response['comprasMes'] = ['error' => $e->getMessage()];
    }


    try {
        $response['comprasClientesMes'] = $controller->comprasClientesMes();
    } catch (Exception $e) {
        $response['comprasMes'] = ['error' => $e->getMessage()];
    }

    try {
        $response['ventasEmpleadosMes'] = $controller->ventasEmpleadosMes();
    } catch (Exception $e) {
        $response['comprasMes'] = ['error' => $e->getMessage()];
    }



    header('Content-Type: application/json');
    echo json_encode($response);
}
?>