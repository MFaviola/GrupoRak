<?php
require_once '../config.php';
require_once 'UsuarioController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if ($id) {
        $controller = new UsuarioController();
        try {
            $mensaje = $controller->eliminarUsuario($id);
            header('Location: ../Controllers/Template.Controller.php?Pages=usuario#');
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
