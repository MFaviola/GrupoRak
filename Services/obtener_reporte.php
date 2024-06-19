<?php
require_once '../Services/ReportesService.php';

if (isset($_GET['filterMonth'], $_GET['filterYear'])) {
    $filterMonth = $_GET['filterMonth'];
    $filterYear = $_GET['filterYear'];
    $controller = new ReportesServices();

    try {
        $reporte = $controller->ReporteCompras1($filterMonth, $filterYear);
        echo json_encode($reporte);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} 

if (isset($_GET['DNI'])) {
    $DNI = $_GET['DNI'];
    $controller = new ReportesServices();

    try {
        $reporte = $controller->ReporteEmpleados($DNI);
        echo json_encode($reporte);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} 

if (isset($_GET['modelo'])) {
    $modelo = $_GET['modelo'];
    $controller = new ReportesServices();

    try {
        $reporte = $controller->ReporteVehiculos($modelo);
        echo json_encode($reporte);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}

if (isset($_GET['ciudad'])) {
    $ciudad = $_GET['ciudad'];
    $controller = new ReportesServices();

    try {
        $reporte = $controller->ReporteVentas($ciudad);
        echo json_encode($reporte);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>