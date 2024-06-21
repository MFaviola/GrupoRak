<?php
require_once '../Services/CompraVehiculoService.php';
if (isset($_GET['IdCompra'])) {
    $id = $_GET['IdCompra'];
    $controller = new CompraVehiculoService();

    try {
        $usuario = $controller->obtenerCompras($id);
        echo json_encode($usuario);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID de usuario no especificado.']);
}
?>