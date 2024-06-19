<?php
require_once '../config.php';
require_once '../Services/RolesService.php';
require_once '../Services/PantallaServices.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rol_descripcion = $_POST['Rol_Descripcion'];
    $pantallasSeleccionadas = explode(',', $_POST['pantallasSeleccionadas']);

    $controller = new RolesController();
    $pantallasController = new PantallasController();

    

    try {
        // Insertar el nuevo rol y obtener el ID
        $stmt = $pdo->prepare("CALL sp_Rol_Insertar(:rol_descripcion, :rol_creacion, :rol_fecha_creacion, @rol_id)");
        $stmt->bindParam(':rol_descripcion', $rol_descripcion);
        $stmt->bindValue(':rol_creacion', 1); // Ajusta según tu lógica
        $stmt->bindValue(':rol_fecha_creacion', date('Y-m-d H:i:s'));
        $stmt->execute();

        // Obtener el ID del nuevo rol
        $result = $pdo->query("SELECT @rol_id AS rol_id")->fetch(PDO::FETCH_ASSOC);
        $rol_id = $result['rol_id'];

        // Depuración
        echo "Rol ID: $rol_id\n";
        echo "Pantallas Seleccionadas: " . implode(', ', $pantallasSeleccionadas) . "\n";

        // Asignar pantallas al rol creado
        foreach ($pantallasSeleccionadas as $pantalla_id) {
            if (!empty($pantalla_id)) { // Verificar que $pantalla_id no esté vacío
                // Depuración
                echo "Asignando Pantalla ID: $pantalla_id\n";
                $pantallasController->asignarPantallaARol($rol_id, $pantalla_id);
            }
        }

        // Redirigir a la página de roles después de la inserción
        header('Location: ../Services/Template.Service.php?Pages=roles#');
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Método de solicitud no permitido.';
}
?>
