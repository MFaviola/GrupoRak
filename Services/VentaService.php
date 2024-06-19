<?php
require_once '../config.php';

class VentaService {

    public function listarMetodosPago() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_MetodoPago_Listar`()';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            throw new Exception('Error al listar métodos de pago: ' . $e->getMessage());
        }
    }

    public function listarVehiculos() {
        global $pdo;
    
        try {
            $sql = 'CALL `dbgruporac`.`sp_Vehiculos_Listar`()';
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
    public function listarDescuentos() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Descuento_Listar`()';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            throw new Exception('Error al listar descuentos: ' . $e->getMessage());
        }
    }

    public function insertarVenta($fecha, $empId, $mpgId, $sedId, $desId, $cliId, $impId, $usuIdCre) {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Ventas_Insertar`(?, ?, ?, ?, ?, ?, ?, ?, @Vnt_ID)';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute([$fecha, $empId, $mpgId, $sedId, $desId, $cliId, $impId, $usuIdCre]);

            $result = $pdo->query("SELECT @Vnt_ID AS Vnt_ID")->fetch(PDO::FETCH_ASSOC);
            return $result['Vnt_ID'];

        } catch (Exception $e) {
            throw new Exception('Error al insertar venta: ' . $e->getMessage());
        }
    }

    public function insertarVentaDetalle($vntId, $precioVenta, $vehPlaca, $usuIdCre) {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Venta_Detalle_Insertar`(?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute([$vntId, $precioVenta, $vehPlaca, $usuIdCre]);

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            throw new Exception('Error al insertar detalle de venta: ' . $e->getMessage());
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
            return $stmt->fetch(PDO::FETCH_ASSOC);
    
        } catch (Exception $e) {
            throw new Exception('Error al buscar cliente por DNI: ' . $e->getMessage());
        }
    }
    



    public function eliminarVentaDetalle($vdtId) {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Venta_Detalle_Eliminar`(?)';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute([$vdtId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            throw new Exception('Error al eliminar detalle de venta: ' . $e->getMessage());
        }
    }
    
}
?>
