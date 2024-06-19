<?php
require_once '../Services/RolesService.php';
require_once '../Services/PantallaServices.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rol_id = $_POST['Rol_Id'];
    $rol_descripcion = $_POST['Rol_Descripcion'];
    $pantallasSeleccionadas = explode(',', $_POST['pantallasSeleccionadas']);

    $controller = new RolesController();
    $pantallaController = new PantallasController();

    try {
        // Actualizar el nombre del rol
        $controller->actualizarRol($rol_id, $rol_descripcion);

        // Eliminar todas las pantallas actuales del rol
        $pantallaController->eliminarPantallasPorRol($rol_id);

        // Asignar las nuevas pantallas al rol
        foreach ($pantallasSeleccionadas as $pantalla_id) {
            if (!empty($pantalla_id)) {
                $pantallaController->asignarPantallaARol($rol_id, $pantalla_id);
            }
        }

        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Método no permitido']);
}
?>
