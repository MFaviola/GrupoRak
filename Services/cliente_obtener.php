<?php
// require_once '../Services/Cliente/cliente_obtener.php';
require_once '../Services/ClienteService.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new ClienteService();

    try {
        $usuario = $controller->obtenerPorID($id);
        echo json_encode($usuario);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID de usuario no especificado.']);
}
?>