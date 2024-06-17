<?php
require_once __DIR__ . '/../config.php';

class VentaService {
    public function obtenerClientePorDNI($dni) {
        global $pdo;
        try {
            $stmt = $pdo->prepare('CALL sp_Cliente_ObtenerPorDNI(:dni)');
            $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
            $stmt->execute();
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($cliente) {
                echo json_encode($cliente);
            } else {
                echo json_encode(['error' => 'Cliente no encontrado']);
            }
        } catch (PDOException $e) {
            error_log('Error al obtener el cliente: ' . $e->getMessage());
            echo json_encode(['error' => 'Error al obtener el cliente']);
        }
    }

    public function listarMetodosPago() {
        global $pdo;
        try {
            $stmt = $pdo->prepare('SELECT Mpg_ID, Mpg_Descripcion FROM Vent_tbMetodosPago WHERE Mpg_Estado = 1');
            $stmt->execute();
            $metodosPago = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($metodosPago);
        } catch (PDOException $e) {
            error_log('Error al listar métodos de pago: ' . $e->getMessage());
            echo json_encode(['error' => 'Error al listar métodos de pago']);
        }
    }

    public function listarDescuentos() {
        global $pdo;
        try {
            $stmt = $pdo->prepare('SELECT Des_ID, Des_Descripcion, Des_Porcentaje FROM Vent_tbDescuentos WHERE Des_Estado = 1');
            $stmt->execute();
            $descuentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($descuentos);
        } catch (PDOException $e) {
            error_log('Error al listar descuentos: ' . $e->getMessage());
            echo json_encode(['error' => 'Error al listar descuentos']);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $service = new VentaService();

    if ($_POST['action'] === 'obtenerClientePorDNI') {
        $dni = $_POST['dni'];
        $service->obtenerClientePorDNI($dni);
    } elseif ($_POST['action'] === 'listarMetodosPago') {
        $service->listarMetodosPago();
    } elseif ($_POST['action'] === 'listarDescuentos') {
        $service->listarDescuentos();
    }
}
