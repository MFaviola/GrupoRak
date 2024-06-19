<?php
require_once '../config.php';

class ClienteService {
    public function listarClientes() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Cliente_Listar`()';
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

    public function insertar($nombre, $apellido, $FechaNacimiento,$Sexo, $Identidad, $Ciudad,$Esciv, $Direccion, $Creacion) {
        global $pdo;
         if (session_status() == PHP_SESSION_NONE) {
             session_start();
        }
        $Creacion = $_SESSION['ID'];

        try {
            $sql = 'CALL `dbgruporac`.`sp_Cliente_Insertar`(?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
            error_log("insertarUsuario - Valores antes de ejecutar: " . json_encode([$nombre, $apellido, $FechaNacimiento,$Sexo, $Identidad, $Ciudad, $Esciv, $Direccion,$Creacion]));
            $stmt->execute([$nombre, $apellido, $FechaNacimiento,$Sexo, $Identidad, $Ciudad, $Esciv,$Direccion, $Creacion]);
            error_log("insertarUsuario - Valores enviados: " . json_encode([$nombre, $apellido, $FechaNacimiento,$Sexo, $Identidad, $Ciudad, $Esciv,$Direccion, $Creacion]));
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

    public function actualizar($id, $nombre, $apellido, $FechaNacimiento,$Sexo, $Identidad, $Ciudad,$Esciv, $Direccion, $Modificacion) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`sp_Cliente_Actualizar`(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
            $stmt->execute([$id, $nombre, $apellido, $FechaNacimiento, $Sexo, $Identidad, $Ciudad,$Esciv,$Direccion,$Modificacion]);
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

    public function CiudadesDDl($id) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`sp_Ciudades_Ddl`(?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Usar fetchAll para obtener todas las filas
            return $result;
        } catch (Exception $e) {
            throw new Exception('Error al obtener ciudades: ' . $e->getMessage());
        }
    }
    

    public function obtenerPorID($id) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`sp_Cliente_Detalle`(?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result;
        } catch (Exception $e) {
            throw new Exception('Error al obtener usuario: ' . $e->getMessage());
        }
    }

    public function eliminar($id) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`sp_Cliente_Eliminar`(?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            return "Usuario eliminado correctamente.";
        } catch (Exception $e) {
            throw new Exception('Error al eliminar usuario: ' . $e->getMessage());
        }
    }
    
    public function listarDepartamentos() {
        global $pdo;
    
        try {
            $sql = 'CALL `dbgruporac`.`sp_Departamentos_Listar`()';
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

  public function listarEstadosCiviles() {
    global $pdo;

    try {
        $sql = 'CALL `dbgruporac`.`sp_EstadoCivil_Listar`()';
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

public function listarCiudades() {
    global $pdo;

    try {
        $sql = 'CALL `dbgruporac`.`sp_Ciudad_Listar`()';
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