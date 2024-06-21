<?php
require_once __DIR__ . '/../config.php';

class CarService {
    public function buscarClientePorDNI($dni) {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Cliente_BuscarPorDNI`(?)';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute([$dni]);
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            throw new Exception('Error al buscar cliente por DNI: ' . $e->getMessage());
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $service = new CarService();

    if ($_POST['action'] === 'buscarClientePorDNI') {
        $dni = $_POST['placa'];
        $service->buscarClientePorDNI($dni);
    }
}
