<?php
require_once 'config.php';

class ClienteService {
    public function listarClientes() {
        global $pdo;

        try {
            $sql = 'CALL `dbGrupoRac`.`sp_Cliente_Listar`()';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute();
            $result = $stmt->fetchAll();

            if ($result === false) {
                throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
            }

            return $result;

        } catch (Exception $e) {
            throw new Exception('Error al listar facturas: ' . $e->getMessage());
        }
    }

    public function insertarCliente($nombre, $apellido, $fechaNac, $sexo, $dni, $direccion) {
        global $pdo;

        try {
            $sql = 'CALL dbprueba.InsertClient(:nombre, :apellido, :fechaNac, :sexo, :dni, :direccion)';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
            $stmt->bindParam(':fechaNac', $fechaNac, PDO::PARAM_STR);
            $stmt->bindParam(':sexo', $sexo, PDO::PARAM_STR);
            $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
            $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);

            $stmt->execute();

        } catch (Exception $e) {
            throw new Exception('Error al insertar cliente: ' . $e->getMessage());
        }
    }
    
}
?>