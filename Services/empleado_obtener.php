<?php
require_once '../Services/EmpleadoService.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new EmpleadoService();

    try {
        $usuario = $controller->obtenerPorID($id);
        echo json_encode($usuario);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID de empleado no especificado.']);
}
?>