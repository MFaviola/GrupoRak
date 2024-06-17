<?php
require_once '../config.php';
require_once '../Services/RolesService.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if ($id) {
        $controller = new RolController();
        try {
            $mensaje = $controller->eliminarRoles($id);
            header('Location: ../Services/Template.Service.php?Pages=roles#');
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
