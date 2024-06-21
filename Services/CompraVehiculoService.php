<?php
require_once '../config.php';

class CompraVehiculoService {
    public function listar() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Compras_Listar`()';
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

    public function listarMetodosPagos() {
        global $pdo;
    
        try {
            $sql = 'CALL `dbgruporac`.`sp_MetodosPago_Listar`()';
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

    public function ModelosDDl($id) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`sp_Modelos_Ddl`(?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Usar fetchAll para obtener todas las filas
            return $result;
        } catch (Exception $e) {
            throw new Exception('Error al obtener ciudades: ' . $e->getMessage());
        }
    }

    public function ListarComprasDetalles($id) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`sp_ComprasDetalle_Listar`(?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Usar fetchAll para obtener todas las filas
            return $result;
        } catch (Exception $e) {
            throw new Exception('Error al obtener ciudades: ' . $e->getMessage());
        }
    }

    public function listarMarcas() {
        global $pdo;
    
        try {
            $sql = 'CALL `dbgruporac`.`sp_Marca_Listar`()';
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
    public function insertarCompraVehiculo($nombre, $apellido, $FechaNacimiento,$Sexo, $Identidad, $Ciudad,$Esciv, $Direccion, $Creacion) {
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
    
    public function insertarVehiculo($placa, $color, $Imagen, $Precio, $Modelo, $Creacion) {
        global $pdo;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $Creacion = $_SESSION['ID'];
        try {
            $sql = 'CALL `dbgruporac`.`sp_Vehiculos_Insertar`(?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
    
            // Debug: Log values before executing
            error_log("insertarVehiculo - Valores antes de ejecutar: " . json_encode([$placa, $color, $Imagen, $Precio, $Modelo, $Creacion]));
            // Execute the statement
            $stmt->execute([$placa, $color, $Imagen, $Precio, $Modelo, $Creacion]);
            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // Debug: Log values after executing
            error_log("insertarVehiculo - Resultado obtenido: " . json_encode($result));
    
            // Check the result
            if ($result && $result['Result'] == 1) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            throw new Exception('Error al insertar vehículo: ' . $e->getMessage());
        }
    }
    
      
    public function insertarEncabezado($fecha, $MetodoPago, $Cliente, $Creacion) {
        global $pdo;
         if (session_status() == PHP_SESSION_NONE) {
             session_start();
        }
        $Creacion = $_SESSION['ID'];

        try {
            $sql = 'CALL `dbgruporac`.`sp_Compras_Insertar`(?, ?, ?, ?,@p_Com_ID)';
            $stmt = $pdo->prepare($sql);
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
            error_log("insertarUsuario - Valores antes de ejecutar: " . json_encode([$fecha, $MetodoPago, $Cliente, $Creacion]));
            $stmt->execute([$fecha, $MetodoPago, $Cliente, $Creacion]);
            error_log("insertarUsuario - Valores enviados: " . json_encode([$fecha, $MetodoPago, $Cliente, $Creacion]));
            $stmt->closeCursor(); // Necesario para llamar a una consulta almacenada que devuelve resultados

            // Obtener el ID generado
            $result = $pdo->query("SELECT @p_Com_ID AS Com_ID")->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result['Com_ID'];
            } else {
                return "0";
            }
        } catch (Exception $e) {
            throw new Exception('Error al insertar usuario: ' . $e->getMessage());
        }
    }

    public function insertarDetalle($PrecioCompra, $CompraId, $Placa,$Impuesto, $Creacion) {
        global $pdo;
         if (session_status() == PHP_SESSION_NONE) {
             session_start();
        }
        $Creacion = $_SESSION['ID'];

        try {
            $sql = 'CALL `dbgruporac`.`sp_ComprasDetalles_Insertar`(?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
    
            // Debug: Log values before executing
            error_log("insertarVehiculo - Valores antes de ejecutar: " . json_encode([$PrecioCompra, $CompraId, $Placa,$Impuesto, $Creacion]));
            // Execute the statement
            $stmt->execute([$PrecioCompra, $CompraId, $Placa,$Impuesto, $Creacion]);
            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // Debug: Log values after executing
            error_log("insertarVehiculo - Resultado obtenido: " . json_encode($result));
    
            // Check the result
            if ($result && $result['Result'] == 1) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            throw new Exception('Error al insertar usuario: ' . $e->getMessage());
        }
    }

    public function eliminarDetalle($id) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`sp_ComprasDetalles_Eliminar`(?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            return "Usuario eliminado correctamente.";
        } catch (Exception $e) {
            throw new Exception('Error al eliminar usuario: ' . $e->getMessage());
        }
    }
    

}
?>