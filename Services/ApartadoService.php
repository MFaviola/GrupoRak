<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/GrupoRak/';
require_once $root . 'config.php';

class ApartadoVehiculoService {
    public function listar() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Apartado_Listar`()';
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

    public function insertarCompraVehiculo($nombre, $apellido, $FechaNacimiento,$Sexo, $Identidad, $Ciudad, $Esciv, $Direccion, $Creacion) {
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

    public function insertarVehiculo($placa, $color, $Imagen,$Precio, $Modelo, $Creacion) {
        global $pdo;
         if (session_status() == PHP_SESSION_NONE) {
             session_start();
        }
        $Creacion = $_SESSION['ID'];

        try {
            $sql = 'CALL `dbgruporac`.`sp_Vehiculos_Insertar`(?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
            error_log("insertarUsuario - Valores antes de ejecutar: " . json_encode([$placa, $color, $Imagen,$Precio, $Modelo, $Creacion]));
            $stmt->execute([$placa, $color, $Imagen,$Precio, $Modelo, $Creacion]);
            error_log("insertarUsuario - Valores enviados: " . json_encode([$placa, $color, $Imagen,$Precio, $Modelo, $Creacion]));
            $result = $stmt->fetch();
            if (isset($result['Result']) && $result['Result'] == 1) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            throw new Exception('Error al insertar usuario: ' . $e->getMessage());
        }
    }
      
    public function insertarEncabezado($fecha, $MetodoPago, $Cliente, $Monto, $Caducacion, $Creacion, $Veh_Placa, $Cantidad, $PrecioCompra) {
        global $pdo;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $Creacion = $_SESSION['ID'];
    
        try {
            $sql = 'CALL `dbgruporac`.`sp_Apartado_Insertar`(?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
            $stmt->execute([$fecha, $MetodoPago, $Cliente, $Monto, $Caducacion, $Creacion, $Veh_Placa, $Cantidad, $PrecioCompra]);
            $result = $stmt->fetch();
            return $result['Result'];
        } catch (Exception $e) {
            throw new Exception('Error al insertar apartado: ' . $e->getMessage());
        }
    }

    public function buscarClientePorDNI($dni) {
        global $pdo;
    
        try {
            $sql = 'CALL `dbgruporac`.`sp_Cliente_BuscarPorDNI`(?)';
            $stmt = $pdo->prepare($sql);
    
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
    
            $stmt->execute([$dni]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($result === false) {
                throw new Exception('Cliente no encontrado');
            }
    
            return $result;
    
        } catch (Exception $e) {
            throw new Exception('Error al buscar cliente por DNI: ' . $e->getMessage());
        }
    }
}
?>