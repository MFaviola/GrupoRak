<?php
require_once __DIR__ . '/../config.php';

class CarService {
    public function obtenerCarroPorPlaca($placa) {
        global $pdo;
        try {
            $stmt = $pdo->prepare('CALL sp_vehiculo_buscarporplaca(:placa)');
            $stmt->bindParam(':placa', $placa, PDO::PARAM_STR);
            $stmt->execute();
            $carro = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($carro) {
                echo json_encode($carro);
            } else {
                echo json_encode(['error' => 'Carro no encontrado']);
            }
        } catch (PDOException $e) {
            error_log('Error al obtener el carro: ' . $e->getMessage());
            echo json_encode(['error' => 'Error al obtener el carro']);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $service = new CarService();

    if ($_POST['action'] === 'obtenerCarroPorPlaca') {
        $placa = $_POST['placa'];
        $service->obtenerCarroPorPlaca($placa);
    }
}
