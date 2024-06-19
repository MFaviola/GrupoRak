<?php
require_once '../Services/RolesService.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new RolesController();

    try {
        $usuario = $controller->obtenerRolesPorID($id);
        echo json_encode($usuario);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID de usuario no especificado.']);
}
?>
