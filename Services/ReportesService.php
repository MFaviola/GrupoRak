<?php
require_once '../config.php';

class ReportesServices {

    public function ReporteCompras1($startDate , $endDate) {
        global $pdo;
        try {
            $sql = 'CALL sp_comprasporfecha_reporte(?, ?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$startDate , $endDate]);
            
            // Use fetchAll to retrieve all rows
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Debugging: print the result
            // echo 'resultado : ';
            // print_r($result);
    
            return $result;
        } catch (Exception $e) {
            throw new Exception('Error al obtener datos: ' . $e->getMessage());
        }
    }


    public function ReporteEmpleados($DNI, $fecha_inicio , $fecha_fin) {
        global $pdo;
        try {
            $sql = 'CALL sp_ventasporempleado_reporte(?,?,?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$DNI, $fecha_inicio, $fecha_fin]);
            
            // Use fetchAll to retrieve all rows
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Debugging: print the result
            // echo 'resultado : ';
            // print_r($result);
    
            return $result;
        } catch (Exception $e) {
            throw new Exception('Error al obtener datos: ' . $e->getMessage());
        }
    }

    public function ReporteVehiculos($modelo, $fecha_inicio, $fecha_fin) {
        global $pdo;
        try {
            $sql = 'CALL sp_vehiculospormodelos_reporte(?,?,?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$modelo, $fecha_inicio, $fecha_fin]);
            
            // Use fetchAll to retrieve all rows
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Debugging: print the result
            // echo 'resultado : ';
            // print_r($result);
    
            return $result;
        } catch (Exception $e) {
            throw new Exception('Error al obtener datos: ' . $e->getMessage());
        }
    }

    public function ReporteVentas($ciudad, $fecha_inicio, $fecha_fin) {
        global $pdo;
        try {
            $sql = 'CALL sp_ventasporciudad_reporte(?,?,?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$ciudad, $fecha_inicio, $fecha_fin]);
            
            // Use fetchAll to retrieve all rows
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Debugging: print the result
            // echo 'resultado : ';
            // print_r($result);
    
            return $result;
        } catch (Exception $e) {
            throw new Exception('Error al obtener datos: ' . $e->getMessage());
        }
    }



    public function listarEmpleado() {
        global $pdo;

        try {
            $sql = 'CALL sp_empleado_listar()';
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
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }

    public function listarModelo() {
        global $pdo;

        try {
            $sql = 'CALL sp_modelo_listar()';
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
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }
    // public function ReporteCompras($filterMonth, $filterYear) {
    //     global $pdo;
    //     echo 'mes: ' . $filterMonth . ' anio: ' . $filterYear;
    
    //     try {
    //         $sql = 'CALL `dbgruporac`.`SP_ComprasPorFecha_Reporte`(:filterMonth, :filterYear)';
    //         $stmt = $pdo->prepare($sql);
    
    //         if ($stmt === false) {
    //             throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
    //         }
    
            
    //         $stmt->bindParam(':filterMonth', $filterMonth, PDO::PARAM_INT);
    //         $stmt->bindParam(':filterYear', $filterYear, PDO::PARAM_INT);
    
    //         $stmt->execute();
    //         $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //         if ($result === false) {
    //             throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
    //         }
    
    //         return $result;
    
    //     } catch (Exception $e) {
    //         throw new Exception('Error al listar: ' . $e->getMessage());
    //     }
    // }
}
?>
