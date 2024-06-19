<?php
require_once '../Services/RolesService.php';
require_once '../Services/PantallaServices.php';

if (isset($_POST['Rol_Descripcion'])) {
    $rolId = $_POST['Rol_Id'] ?? null;
    $rolDescripcion = $_POST['Rol_Descripcion'];
    $pantallasSeleccionadas = isset($_POST['pantallasSeleccionadas']) ? explode(",", $_POST['pantallasSeleccionadas']) : [];

    $rolesController = new RolesController();
    $pantallasController = new PantallasController();

    try {
        if ($rolId) {
            // Actualizar rol existente
            $rolesController->actualizarRol($rolId, $rolDescripcion);
            // Eliminar pantallas existentes
            $pantallasController->eliminarPantallasPorRol($rolId);
        } else {
            // Crear nuevo rol
            $rolId = $rolesController->insertarRol($rolDescripcion, '', '');
        }

        // Asignar nuevas pantallas
        foreach ($pantallasSeleccionadas as $pantallaId) {
            $pantallasController->asignarPantallaARol($rolId, $pantallaId);
        }

        echo 'Rol guardado exitosamente';
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Datos incompletos';
}
?>
