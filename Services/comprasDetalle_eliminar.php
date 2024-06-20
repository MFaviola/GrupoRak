<?php
// require_once '../Services/Cliente/cliente_obtener.php';
require_once '../Services/CompraVehiculoService.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new CompraVehiculoService();

    try {
        $usuario = $controller->eliminarDetalle($id);
        echo json_encode($usuario);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID de usuario no especificado.']);
}
?>