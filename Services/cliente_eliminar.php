<?php
// require_once '../../Services/Cliente/cliente/eliminar.php';
require_once '../config.php';
require_once '../Services/ClienteService.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if ($id) {
        $controller = new ClienteService();
        try {
            $mensaje = $controller->eliminar($id);
            header('Location: ../Services/Template.Service.php?Pages=cliente#');
            exit;
        } catch (Exception $e) {
            echo 'Error al eliminar usuario: ' . $e->getMessage();
        }
    } else {
        echo 'ID de usuario no especificado.';
    }
} else {
    echo 'Método de solicitud no permitido.';
}
?>