<?php
require_once '../config.php';

class RolesController {
    public function listarRoles() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Rol_Listar`()';
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

    public function obtenerRolesPorID($id) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`sp_Rol_Detalle`(?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result;
        } catch (Exception $e) {
            throw new Exception('Error al obtener usuario: ' . $e->getMessage());
        }
    }

    public function eliminarRoles($id) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`sp_Rol_Eliminar`(?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            return "Usuario eliminado correctamente.";
        } catch (Exception $e) {
            throw new Exception('Error al eliminar usuario: ' . $e->getMessage());
        }
    }


    
}
?>