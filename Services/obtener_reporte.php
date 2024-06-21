<?php
require_once '../Services/ReportesService.php';


if (isset($_GET['DNI'], $_GET['fecha_inicio'], $_GET['fecha_fin'])) {
    $DNI = $_GET['DNI'];
    $fecha_inicio = $_GET['fecha_inicio'];
    $fecha_fin = $_GET['fecha_fin'];
    $controller = new ReportesServices();

    try {
        $reporte = $controller->ReporteEmpleados($DNI, $fecha_inicio, $fecha_fin);
        echo json_encode($reporte);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} 

if (isset($_GET['modelo'], $_GET['fecha_inicio'], $_GET['fecha_fin'])) {
    $modelo = $_GET['modelo'];
    $fecha_inicio = $_GET['fecha_inicio'];
    $fecha_fin = $_GET['fecha_fin'];
    $controller = new ReportesServices();

    try {
        $reporte = $controller->ReporteVehiculos($modelo, $fecha_inicio, $fecha_fin);
        echo json_encode($reporte);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}

if (isset($_GET['ciudad'], $_GET['fecha_inicio'], $_GET['fecha_fin'])) {
    $ciudad = $_GET['ciudad'];
    $fecha_inicio = $_GET['fecha_inicio'];
    $fecha_fin = $_GET['fecha_fin'];
    $controller = new ReportesServices();

    try {
        $reporte = $controller->ReporteVentas($ciudad, $fecha_inicio, $fecha_fin);
        echo json_encode($reporte);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}


if (isset($_GET['startDate'], $_GET['endDate'])) {
    $startDate  = $_GET['startDate'];
    $endDate = $_GET['endDate'];
    $controller = new ReportesServices();

    try {
        $reporte = $controller->ReporteCompras1($startDate , $endDate);
        echo json_encode($reporte);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} 
?>