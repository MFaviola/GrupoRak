<?php
require_once '../config.php';

class UsuarioController {
    public function listarUsuario() {
        global $pdo;
        try {
            $sql = 'CALL sp_usuarios_mostrar()';
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
            throw new Exception('Error al listar usuarios: ' . $e->getMessage());
        }
    }

    public function insertarUsuario($usuario, $contra, $admin, $rolId, $emplId) {
        global $pdo;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $usuCre = $_SESSION['ID'];
        $fechaCreacion = date('Y-m-d');
        error_log("insertarUsuario - Usu_Admin (preparado): " . $admin);
        try {
            $sql = 'CALL sp_usuarios_insertar(?, ?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
            error_log("insertarUsuario - Valores antes de ejecutar: " . json_encode([$usuario, $contra, $admin, $rolId, $emplId, $usuCre, $fechaCreacion]));
            $stmt->execute([$usuario, $contra, $admin, $rolId, $emplId, $usuCre, $fechaCreacion]);
            error_log("insertarUsuario - Valores enviados: " . json_encode([$usuario, $contra, $admin, $rolId, $emplId, $usuCre, $fechaCreacion]));
            $result = $stmt->fetch();
            if (isset($result['Result']) && $result['Result'] == 1) {
                return "Usuario insertado correctamente.";
            } else {
                return "No se pudo insertar el usuario.";
            }
        } catch (Exception $e) {
            throw new Exception('Error al insertar usuario: ' . $e->getMessage());
        }
    }

    public function actualizarUsuario($id, $usuario, $admin, $rolId, $emplId, $usu_id_modi) {
        global $pdo;
        $fechaModifica = date('Y-m-d');
        try {
            $sql = 'CALL sp_usuario_actualizar(?, ?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
            $stmt->execute([$id, $usuario, $admin, $rolId, $emplId, $usu_id_modi, $fechaModifica]);
            $result = $stmt->fetch();
            if (isset($result['Result']) && $result['Result'] == 1) {
                return "Usuario actualizado correctamente.";
            } else {
                return "No se pudo actualizar el usuario.";
            }
        } catch (Exception $e) {
            throw new Exception('Error al actualizar usuario: ' . $e->getMessage());
        }
    }

    public function obtenerUsuarioPorID($id) {
        global $pdo;
        try {
            $sql = 'CALL sp_usuarios_detalles(?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result;
        } catch (Exception $e) {
            throw new Exception('Error al obtener usuario: ' . $e->getMessage());
        }
    }

    public function eliminarUsuario($id) {
        global $pdo;
        try {
            $sql = 'CALL sp_usuario_eliminar(?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            return "Usuario eliminado correctamente.";
        } catch (Exception $e) {
            throw new Exception('Error al eliminar usuario: ' . $e->getMessage());
        }
    }


    public function listarempleados() {
        global $pdo;

        try {
            $sql = 'CALL sp_empleado_listar_2()';
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
