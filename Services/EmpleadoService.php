<?php
require_once __DIR__ . '/../config.php';
session_start();

class EmpleadoService {
    public function listarEmpleados() {
        global $pdo;
        try {
            $sql = 'CALL sp_Empleado_Listar()';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data = array();
            foreach ($result as $row) {
                $data[] = array(
                    'Empl_Id' => $row['Empl_Id'],
                    'Empl_Nombre' => $row['Empl_Nombre'],
                    'Empl_Apellido' => $row['Empl_Apellido'],
                    'Empl_Sexo' => $row['Empl_Sexo'],
                    'Empl_FechaNac' => $row['Empl_FechaNac'],
                    'Ciudad' => $row['Ciudad'],
                    'EstadoCivil' => $row['EstadoCivil'],
                    'Sede' => $row['Sede'],
                    'Cargo' => $row['Cargo'],
                    'Empl_DNI' => $row['Empl_DNI'],
                    'UsuarioCreacion' => $row['UsuarioCreacion'],
                    'UsuarioModificacion' => $row['UsuarioModificacion'],
                    'FechaCreacion' => $row['Empl_FechaCreacion'],
                    'FechaModificacion' => $row['Empl_FechaModificacion']
                );
            }
            echo json_encode(array('data' => $data));
        } catch (Exception $e) {
            throw new Exception('Error al listar empleados: ' . $e->getMessage());
        }
    }

    public function insertarEmpleado($Empl_Nombre, $Empl_Apellido, $Empl_Sexo, $Empl_FechaNac, $Ciu_Id, $Est_ID, $Sed_ID, $Carg_Id, $Empl_DNI) {
        global $pdo;
        try {
            $usuarioCreacion = 1; 
            $sql = 'CALL sp_Empleado_Insertar(
                        :Empl_Nombre, 
                        :Empl_Apellido, 
                        :Empl_Sexo, 
                        :Empl_FechaNac, 
                        :Ciu_Id, 
                        :Est_ID, 
                        :Sed_ID, 
                        :Carg_Id, 
                        :Empl_UsuarioCreacion, 
                        :Empl_DNI, 
                        @p_Result
                    )';

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':Empl_Nombre', $Empl_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(':Empl_Apellido', $Empl_Apellido, PDO::PARAM_STR);
            $stmt->bindParam(':Empl_Sexo', $Empl_Sexo, PDO::PARAM_STR);
            $stmt->bindParam(':Empl_FechaNac', $Empl_FechaNac, PDO::PARAM_STR);
            $stmt->bindParam(':Ciu_Id', $Ciu_Id, PDO::PARAM_STR);
            $stmt->bindParam(':Est_ID', $Est_ID, PDO::PARAM_INT);
            $stmt->bindParam(':Sed_ID', $Sed_ID, PDO::PARAM_INT);
            $stmt->bindParam(':Carg_Id', $Carg_Id, PDO::PARAM_INT);
            $stmt->bindParam(':Empl_UsuarioCreacion', $usuarioCreacion, PDO::PARAM_INT);
            $stmt->bindParam(':Empl_DNI', $Empl_DNI, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                $result = $pdo->query("SELECT @p_Result AS p_Result")->fetch(PDO::FETCH_ASSOC);

                error_log("Respuesta de la base de datos: " . json_encode($result));

                if ($result['p_Result'] == 1) {
                    return 1; 
                } else {
                    error_log("Error al insertar empleado: Fallo en la base de datos. Datos: " . json_encode([
                        'Empl_Nombre' => $Empl_Nombre,
                        'Empl_Apellido' => $Empl_Apellido,
                        'Empl_Sexo' => $Empl_Sexo,
                        'Empl_FechaNac' => $Empl_FechaNac,
                        'Ciu_Id' => $Ciu_Id,
                        'Est_ID' => $Est_ID,
                        'Sed_ID' => $Sed_ID,
                        'Carg_Id' => $Carg_Id,
                        'Empl_UsuarioCreacion' => $usuarioCreacion,
                        'Empl_DNI' => $Empl_DNI
                    ]));
                    return 0; 
                }
            } else {
                $errorInfo = $stmt->errorInfo();
                error_log("Error al ejecutar el procedimiento almacenado: " . $errorInfo[2]);
                return 0; 
            }
        } catch (PDOException $e) {
            error_log("Error al insertar empleado: " . $e->getMessage());
            return 0; 
        }
    }

    public function insertarEmpleadoDirecto($Empl_Nombre, $Empl_Apellido, $Empl_Sexo, $Empl_FechaNac, $Ciu_Id, $Est_ID, $Sed_ID, $Carg_Id, $Empl_DNI) {
        global $pdo;
        try {
            $usuarioCreacion = 1; 

            $sql = "INSERT INTO Gral_tbEmpleados (
                        Empl_Nombre, 
                        Empl_Apellido, 
                        Empl_Sexo, 
                        Empl_FechaNac, 
                        Ciu_Id, 
                        Est_ID, 
                        Sed_ID, 
                        Carg_Id, 
                        Empl_UsuarioCreacion, 
                        Empl_FechaCreacion, 
                        Empl_Estado, 
                        Empl_DNI
                    ) VALUES (
                        :Empl_Nombre, 
                        :Empl_Apellido, 
                        :Empl_Sexo, 
                        :Empl_FechaNac, 
                        :Ciu_Id, 
                        :Est_ID, 
                        :Sed_ID, 
                        :Carg_Id, 
                        :Empl_UsuarioCreacion, 
                        CURDATE(), 
                        1, 
                        :Empl_DNI
                    )";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':Empl_Nombre', $Empl_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(':Empl_Apellido', $Empl_Apellido, PDO::PARAM_STR);
            $stmt->bindParam(':Empl_Sexo', $Empl_Sexo, PDO::PARAM_STR);
            $stmt->bindParam(':Empl_FechaNac', $Empl_FechaNac, PDO::PARAM_STR);
            $stmt->bindParam(':Ciu_Id', $Ciu_Id, PDO::PARAM_STR);
            $stmt->bindParam(':Est_ID', $Est_ID, PDO::PARAM_INT);
            $stmt->bindParam(':Sed_ID', $Sed_ID, PDO::PARAM_INT);
            $stmt->bindParam(':Carg_Id', $Carg_Id, PDO::PARAM_INT);
            $stmt->bindParam(':Empl_UsuarioCreacion', $usuarioCreacion, PDO::PARAM_INT);
            $stmt->bindParam(':Empl_DNI', $Empl_DNI, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return 1; 
            } else {
                $errorInfo = $stmt->errorInfo();
                error_log("Error al ejecutar la inserción directa: " . $errorInfo[2]);
                return 0; 
            }
        } catch (PDOException $e) {
            error_log("Error al insertar empleado directamente: " . $e->getMessage());
            return 0;
        }
    }

    public function insertarEmpleadoConFallback($Empl_Nombre, $Empl_Apellido, $Empl_Sexo, $Empl_FechaNac, $Ciu_Id, $Est_ID, $Sed_ID, $Carg_Id, $Empl_DNI) {
        $resultado = $this->insertarEmpleado($Empl_Nombre, $Empl_Apellido, $Empl_Sexo, $Empl_FechaNac, $Ciu_Id, $Est_ID, $Sed_ID, $Carg_Id, $Empl_DNI);

        if ($resultado == 0) {
            error_log("Fallo en el procedimiento almacenado, intentando inserción directa.");
            $resultado = $this->insertarEmpleadoDirecto($Empl_Nombre, $Empl_Apellido, $Empl_Sexo, $Empl_FechaNac, $Ciu_Id, $Est_ID, $Sed_ID, $Carg_Id, $Empl_DNI);
        }

        return $resultado;
    }

    public function actualizarEmpleado($Empl_Id, $Empl_Nombre, $Empl_Apellido, $Empl_Sexo, $Empl_FechaNac, $Ciu_Id, $Est_ID, $Sed_ID, $Carg_Id, $Empl_DNI) {
        global $pdo;
        try {
            $usuarioModificacion = $_SESSION['Usua_Id']; 

            $sql = 'CALL sp_Empleado_Actualizar(
                        :Empl_Id, 
                        :Empl_Nombre, 
                        :Empl_Apellido, 
                        :Empl_Sexo, 
                        :Empl_FechaNac, 
                        :Ciu_Id, 
                        :Est_ID, 
                        :Sed_ID, 
                        :Carg_Id, 
                        :Empl_UsuarioModificacion, 
                        :Empl_DNI, 
                        @p_Result
                    )';

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':Empl_Id', $Empl_Id, PDO::PARAM_INT);
            $stmt->bindParam(':Empl_Nombre', $Empl_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(':Empl_Apellido', $Empl_Apellido, PDO::PARAM_STR);
            $stmt->bindParam(':Empl_Sexo', $Empl_Sexo, PDO::PARAM_STR);
            $stmt->bindParam(':Empl_FechaNac', $Empl_FechaNac, PDO::PARAM_STR);
            $stmt->bindParam(':Ciu_Id', $Ciu_Id, PDO::PARAM_STR);
            $stmt->bindParam(':Est_ID', $Est_ID, PDO::PARAM_INT);
            $stmt->bindParam(':Sed_ID', $Sed_ID, PDO::PARAM_INT);
            $stmt->bindParam(':Carg_Id', $Carg_Id, PDO::PARAM_INT);
            $stmt->bindParam(':Empl_UsuarioModificacion', $usuarioModificacion, PDO::PARAM_INT);
            $stmt->bindParam(':Empl_DNI', $Empl_DNI, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                $result = $pdo->query("SELECT @p_Result AS p_Result")->fetch(PDO::FETCH_ASSOC);

                error_log("Respuesta de la base de datos: " . json_encode($result));

                if ($result['p_Result'] == 1) {
                    return 1; 
                } else {
                    error_log("Error al actualizar empleado: Fallo en la base de datos. Datos: " . json_encode([
                        'Empl_Id' => $Empl_Id,
                        'Empl_Nombre' => $Empl_Nombre,
                        'Empl_Apellido' => $Empl_Apellido,
                        'Empl_Sexo' => $Empl_Sexo,
                        'Empl_FechaNac' => $Empl_FechaNac,
                        'Ciu_Id' => $Ciu_Id,
                        'Est_ID' => $Est_ID,
                        'Sed_ID' => $Sed_ID,
                        'Carg_Id' => $Carg_Id,
                        'Empl_UsuarioModificacion' => $usuarioModificacion,
                        'Empl_DNI' => $Empl_DNI
                    ]));
                    return 0; 
                }
            } else {
                $errorInfo = $stmt->errorInfo();
                error_log("Error al ejecutar el procedimiento almacenado: " . $errorInfo[2]);
                return 0; 
            }
        } catch (PDOException $e) {
            error_log("Error al actualizar empleado: " . $e->getMessage());
            return 0; 
        }
    }

    public function actualizarEmpleadoDirecto($Empl_Id, $Empl_Nombre, $Empl_Apellido, $Empl_Sexo, $Empl_FechaNac, $Ciu_Id, $Est_ID, $Sed_ID, $Carg_Id, $Empl_DNI) {
        global $pdo;
        try {
            // $usuarioModificacion = $_SESSION['Usua_Id']; 
            $usuarioModificacion = 1; 

            $sql = "UPDATE Gral_tbEmpleados
                    SET Empl_Nombre = :Empl_Nombre,
                        Empl_Apellido = :Empl_Apellido,
                        Empl_Sexo = :Empl_Sexo,
                        Empl_FechaNac = :Empl_FechaNac,
                        Ciu_Id = :Ciu_Id,
                        Est_ID = :Est_ID,
                        Sed_ID = :Sed_ID,
                        Carg_Id = :Carg_Id,
                        Empl_UsuarioModificacion = :Empl_UsuarioModificacion,
                        Empl_FechaModificacion = CURDATE(),
                        Empl_DNI = :Empl_DNI
                    WHERE Empl_Id = :Empl_Id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':Empl_Id', $Empl_Id, PDO::PARAM_INT);
            $stmt->bindParam(':Empl_Nombre', $Empl_Nombre, PDO::PARAM_STR);
            $stmt->bindParam(':Empl_Apellido', $Empl_Apellido, PDO::PARAM_STR);
            $stmt->bindParam(':Empl_Sexo', $Empl_Sexo, PDO::PARAM_STR);
            $stmt->bindParam(':Empl_FechaNac', $Empl_FechaNac, PDO::PARAM_STR);
            $stmt->bindParam(':Ciu_Id', $Ciu_Id, PDO::PARAM_STR);
            $stmt->bindParam(':Est_ID', $Est_ID, PDO::PARAM_INT);
            $stmt->bindParam(':Sed_ID', $Sed_ID, PDO::PARAM_INT);
            $stmt->bindParam(':Carg_Id', $Carg_Id, PDO::PARAM_INT);
            $stmt->bindParam(':Empl_UsuarioModificacion', $usuarioModificacion, PDO::PARAM_INT);
            $stmt->bindParam(':Empl_DNI', $Empl_DNI, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return 1; 
            } else {
                $errorInfo = $stmt->errorInfo();
                error_log("Error al ejecutar la actualización directa: " . $errorInfo[2]);
                return 0; 
            }
        } catch (PDOException $e) {
            error_log("Error al actualizar empleado directamente: " . $e->getMessage());
            return 0; 
        }
    }

    public function actualizarEmpleadoConFallback($Empl_Id, $Empl_Nombre, $Empl_Apellido, $Empl_Sexo, $Empl_FechaNac, $Ciu_Id, $Est_ID, $Sed_ID, $Carg_Id, $Empl_DNI) {
        $resultado = $this->actualizarEmpleado($Empl_Id, $Empl_Nombre, $Empl_Apellido, $Empl_Sexo, $Empl_FechaNac, $Ciu_Id, $Est_ID, $Sed_ID, $Carg_Id, $Empl_DNI);

        if ($resultado == 0) {
            error_log("Fallo en el procedimiento almacenado, intentando actualización directa.");
            $resultado = $this->actualizarEmpleadoDirecto($Empl_Id, $Empl_Nombre, $Empl_Apellido, $Empl_Sexo, $Empl_FechaNac, $Ciu_Id, $Est_ID, $Sed_ID, $Carg_Id, $Empl_DNI);
        }

        return $resultado;
    }

    public function eliminarEmpleado($Empl_Id) {
        global $pdo;
        try {
            $sql = 'CALL sp_Empleado_Eliminar(:Empl_Id, @p_Result)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':Empl_Id', $Empl_Id, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                $result = $pdo->query("SELECT @p_Result AS p_Result")->fetch(PDO::FETCH_ASSOC);

                error_log("Respuesta de la base de datos: " . json_encode($result));

                if ($result['p_Result'] == 1) {
                    return 1; 
                } else {
                    error_log("Error al eliminar empleado: Fallo en la base de datos. Datos: " . json_encode([
                        'Empl_Id' => $Empl_Id
                    ]));
                    return 0;
                }
            } else {
                $errorInfo = $stmt->errorInfo();
                error_log("Error al ejecutar el procedimiento almacenado: " . $errorInfo[2]);
                return 0; 
            }
        } catch (PDOException $e) {
            error_log("Error al eliminar empleado: " . $e->getMessage());
            return 0; 
        }
    }

    public function eliminarEmpleadoDirecto($Empl_Id) {
        global $pdo;
        try {
            $sql = "UPDATE Gral_tbEmpleados
                    SET Empl_Estado = 0
                    WHERE Empl_Id = :Empl_Id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':Empl_Id', $Empl_Id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return 1; // Éxito
            } else {
                $errorInfo = $stmt->errorInfo();
                error_log("Error al ejecutar la eliminación directa: " . $errorInfo[2]);
                return 0; // Fallo
            }
        } catch (PDOException $e) {
            error_log("Error al eliminar empleado directamente: " . $e->getMessage());
            return 0; 
        }
    }

    public function eliminarEmpleadoConFallback($Empl_Id) {
        $resultado = $this->eliminarEmpleado($Empl_Id);

        if ($resultado == 0) {
            error_log("Fallo en el procedimiento almacenado, intentando eliminación directa.");
            $resultado = $this->eliminarEmpleadoDirecto($Empl_Id);
        }

        return $resultado;
    }

    public function buscarEmpleadoPorId($Empl_Id) {
        global $pdo;
        try {
            $sql = 'CALL sp_Empleado_Detalle(:Empl_Id)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':Empl_Id', $Empl_Id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(array('data' => $result));
        } catch (Exception $e) {
            throw new Exception('Error al buscar el empleado: ' . $e->getMessage());
        }
    }

    public function listarCiudades() {
        global $pdo;
        try {
            $sql = 'CALL sp_Ciudad_Listar()';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(array('data' => $result));
        } catch (Exception $e) {
            throw new Exception('Error al listar ciudades: ' . $e->getMessage());
        }
    }

    public function listarEstadosCiviles() {
        global $pdo;
        try {
            $sql = 'CALL sp_EstadoCivil_Listar()';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(array('data' => $result));
        } catch (Exception $e) {
            throw new Exception('Error al listar estados civiles: ' . $e->getMessage());
        }
    }

    public function listarSedes() {
        global $pdo;
        try {
            $sql = 'CALL sp_Sedes_Listar()';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(array('data' => $result));
        } catch (Exception $e) {
            throw new Exception('Error al listar sedes: ' . $e->getMessage());
        }
    }

    public function listarCargos() {
        global $pdo;
        try {
            $sql = 'CALL sp_Cargo_Listar()';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return json_encode(array('data' => $result));
        } catch (Exception $e) {
            throw new Exception('Error al listar cargos: ' . $e->getMessage());
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $service = new EmpleadoService();

    if ($_POST['action'] === 'listarEmpleados') {
        $service->listarEmpleados();
    } elseif ($_POST['action'] === 'insertar') {
        $Empl_Nombre = $_POST['Empl_Nombre'];
        $Empl_Apellido = $_POST['Empl_Apellido'];
        $Empl_Sexo = $_POST['Empl_Sexo'];
        $Empl_FechaNac = $_POST['Empl_FechaNac'];
        $Ciu_Id = $_POST['Ciu_Id'];
        $Est_ID = $_POST['Est_ID'];
        $Sed_ID = $_POST['Sed_ID'];
        $Carg_Id = $_POST['Carg_Id'];
        $Empl_DNI = $_POST['Empl_DNI'];
        
        $resultado = $service->insertarEmpleadoConFallback($Empl_Nombre, $Empl_Apellido, $Empl_Sexo, $Empl_FechaNac, $Ciu_Id, $Est_ID, $Sed_ID, $Carg_Id, $Empl_DNI);
        echo $resultado;
    } elseif ($_POST['action'] === 'actualizar') {
        $Empl_Id = $_POST['Empl_Id'];
        $Empl_Nombre = $_POST['Empl_Nombre'];
        $Empl_Apellido = $_POST['Empl_Apellido'];
        $Empl_Sexo = $_POST['Empl_Sexo'];
        $Empl_FechaNac = $_POST['Empl_FechaNac'];
        $Ciu_Id = $_POST['Ciu_Id'];
        $Est_ID = $_POST['Est_ID'];
        $Sed_ID = $_POST['Sed_ID'];
        $Carg_Id = $_POST['Carg_Id'];
        $Empl_DNI = $_POST['Empl_DNI'];
        
        $resultado = $service->actualizarEmpleadoConFallback($Empl_Id, $Empl_Nombre, $Empl_Apellido, $Empl_Sexo, $Empl_FechaNac, $Ciu_Id, $Est_ID, $Sed_ID, $Carg_Id, $Empl_DNI);
        echo $resultado;
    } elseif ($_POST['action'] === 'eliminar') {
        $Empl_Id = $_POST['Empl_Id'];
        
        $resultado = $service->eliminarEmpleadoConFallback($Empl_Id);
        echo $resultado;
    } elseif ($_POST['action'] === 'buscar') {
        $Empl_Id = $_POST['Empl_Id'];
        $resultado = $service->buscarEmpleadoPorId($Empl_Id);
        echo $resultado;
    } elseif ($_POST['action'] === 'sp_Ciudad_Listar') {
        echo $service->listarCiudades();
    } elseif ($_POST['action'] === 'sp_EstadoCivil_Listar') {
        echo $service->listarEstadosCiviles();
    } elseif ($_POST['action'] === 'sp_Sedes_Listar') {
        echo $service->listarSedes();
    } elseif ($_POST['action'] === 'sp_Cargo_Listar') {
        echo $service->listarCargos();
    }
}
?>
