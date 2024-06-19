<?php
require_once '../Services/RolesService.php';
require_once '../Services/PantallaServices.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new RolesController();
    $pantallasController = new PantallasController();

    try {
        $rol = $controller->obtenerRolesPorID($id);
        if ($rol) {
            // Obtener pantallas asignadas y disponibles
            $pantallasAsignadas = $pantallasController->listarPantallasPorRol($id);
            $pantallasDisponibles = $pantallasController->listarPantallasDisponibles($id);

            // Añadir las pantallas asignadas y disponibles al rol
            $rol['pantallasAsignadas'] = $pantallasAsignadas;
            $rol['pantallasDisponibles'] = $pantallasDisponibles;

            echo json_encode($rol);
        } else {
            echo json_encode(['error' => 'El rol no existe.']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID de rol no especificado.']);
}
?>
