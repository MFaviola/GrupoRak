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
} else {
    echo json_encode(['error' => 'ID de usuario no especificado.']);
}
?>