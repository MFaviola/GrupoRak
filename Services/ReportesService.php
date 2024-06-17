<?php
require_once '../config.php';

class ReportesServices {

    public function ReporteCompras($filterMonth, $filterYear) {
        global $pdo;
        echo 'mes: ' . $filterMonth . ' anio: ' . $filterYear;
    
        try {
            $sql = 'CALL `dbgruporac`.`SP_ComprasPorFecha_Reporte`(:filterMonth, :filterYear)';
            $stmt = $pdo->prepare($sql);
    
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
    
            
            $stmt->bindParam(':filterMonth', $filterMonth, PDO::PARAM_INT);
            $stmt->bindParam(':filterYear', $filterYear, PDO::PARAM_INT);
    
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            if ($result === false) {
                throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
            }
    
            return $result;
    
        } catch (Exception $e) {
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }


    public function ReporteCompras1($filterMonth, $filterYear) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`SP_ComprasPorFecha_Reporte`(?, ?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$filterMonth, $filterYear]);
            
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
}
?>
