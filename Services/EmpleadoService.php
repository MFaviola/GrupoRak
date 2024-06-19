<?php
require_once '../config.php';

class EmpleadoService {

    public function listarEmpleados() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Empleado_Listar`()';
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
            throw new Exception('Error al listar empleados: ' . $e->getMessage());
        }
    }

    public function insertar($nombre, $apellido, $Sexo,$FechaNacimiento, $Ciudad,$Esciv,$Cargo, $Sede, $Correo,  $Creacion, $Identidad) {
        global $pdo;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $Creacion = $_SESSION['ID'];

        try {
            $sql = 'CALL `dbgruporac`.`sp_Empleado_Insertar`(?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
            $stmt->execute([$nombre, $apellido,$Sexo, $FechaNacimiento, $Ciudad, $Esciv, $Cargo, $Sede, $Correo, $Creacion,$Identidad]);
            $result = $stmt->fetch();
            if (isset($result['Result']) && $result['Result'] == 1) {
                $_SESSION['mensaje'] = "Empleado insertado correctamente.";
                $_SESSION['mensaje_tipo'] = "success";
            } else {
                $_SESSION['mensaje'] = "Empleado insertado correctamente.";
                $_SESSION['mensaje_tipo'] = "success";
            }
        } catch (Exception $e) {
            $_SESSION['mensaje'] = 'Empleado insertado correctamente.' . $e->getMessage();
            $_SESSION['mensaje_tipo'] = "success";
        }
    }

    public function actualizar($id, $nombre, $apellido,$Sexo, $FechaNacimiento, $Ciudad, $Esciv,$cargo, $sede,  $Correo,  $Identidad, $Modificacion) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`sp_Empleado_Actualizar`(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
            $stmt->execute([$id, $nombre, $apellido,$Sexo, $FechaNacimiento, $Ciudad, $Esciv,$cargo, $sede,  $Correo,  $Identidad, $Modificacion]);
            $result = $stmt->fetch();
            if (isset($result['Result']) && $result['Result'] == 1) {
                $_SESSION['mensaje'] = "Empleado actualizado correctamente.";
                $_SESSION['mensaje_tipo'] = "success";
            } else {
                $_SESSION['mensaje'] = "Empleado actualizado correctamente.";
                $_SESSION['mensaje_tipo'] = "success";
            }
        } catch (Exception $e) {
            $_SESSION['mensaje'] = 'Error al actualizar empleado: ' . $e->getMessage();
            $_SESSION['mensaje_tipo'] = "success";
        }
    }

    public function obtenerPorID($id) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`sp_Empleado_Detalle`(?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result;
        } catch (Exception $e) {
            throw new Exception('Error al obtener empleado: ' . $e->getMessage());
        }
    }

    public function eliminar($id) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`sp_Empleado_Eliminar`(?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            if (isset($result['Result']) && $result['Result'] == 1) {
                $_SESSION['mensaje'] = "Empleado eliminado correctamente.";
                $_SESSION['mensaje_tipo'] = "success";
            } else {
                $_SESSION['mensaje'] = "No se pudo eliminar el empleado.";
                $_SESSION['mensaje_tipo'] = "error";
            }
        } catch (Exception $e) {
            $_SESSION['mensaje'] = 'Error al eliminar empleado: ' . $e->getMessage();
            $_SESSION['mensaje_tipo'] = "error";
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
            throw new Exception('Error al listar estados civiles: ' . $e->getMessage());
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
            throw new Exception('Error al listar ciudades: ' . $e->getMessage());
        }
    }

    public function listarCargo() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Cargo_Listar`()';
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
            throw new Exception('Error al listar cargos: ' . $e->getMessage());
        }
    }

    public function listarSede() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Sedes_Listar`()';
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
            throw new Exception('Error al listar sedes: ' . $e->getMessage());
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
            throw new Exception('Error al listar departamentos: ' . $e->getMessage());
        }
    }
}
?>
