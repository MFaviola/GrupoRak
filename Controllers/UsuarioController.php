<?php
require_once 'config.php';

class UsuarioController {
    public function listarUsuario() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Usuario_Listar`()';
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

    
}
?>