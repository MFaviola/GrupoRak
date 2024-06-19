<?php
require_once '../config.php';
require_once '../Services/PantallaServices.php';

$pantallasController = new PantallasController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $rol_id = $_POST['rol_id'];
    $pantalla_id = $_POST['pantalla_id'];

    try {
        if ($action === 'agregar') {
            $pantallasController->asignarPantallaARol($rol_id, $pantalla_id);
        } elseif ($action === 'eliminar') {
            $pantallasController->eliminarPantallaDeRol($rol_id, $pantalla_id);
        }
        echo "Operación completada";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
