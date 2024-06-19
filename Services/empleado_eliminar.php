<?php
require_once '../config.php';
require_once '../Services/EmpleadoService.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if ($id) {
        $controller = new EmpleadoService();
        try {
            $mensaje = $controller->eliminar($id);
            header('Location: ../Services/Template.Service.php?Pages=empleados#');
            exit;
        } catch (Exception $e) {
            echo 'Error al empleado usuario: ' . $e->getMessage();
        }
    } else {
        echo 'ID de empleado no especificado.';
    }
} else {
    echo 'Método de solicitud no permitido.';
}
?>