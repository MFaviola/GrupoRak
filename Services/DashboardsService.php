<?php
require_once '../config.php';

class DashboardsServices {


    public function cantidadMarcas() {
        global $pdo;

        try {

            $sql = 'CALL `dbgruporac`.`SP_Marcas_Cantidad`();';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_COLUMN);

            if ($result === false) {
                throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
            }

            return $result;

        } catch (Exception $e) {
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }

    public function cantidadVehiculos() {
        global $pdo;

        try {
            
            $sql = 'CALL `dbgruporac`.`SP_Vehiculos_Cantidad`();';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_COLUMN);

            if ($result === false) {
                throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
            }

            return $result;

        } catch (Exception $e) {
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }

    public function cantidadVentas() {
        global $pdo;

        try {
            
            $sql = 'CALL `dbgruporac`.`SP_Ventas_Cantidad`();';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute();
           
            $result = $stmt->fetch(PDO::FETCH_COLUMN);

            if ($result === false) {
                throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
            }

            return $result;

        } catch (Exception $e) {
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }

    public function cantidadCompras() {
        global $pdo;

        try {
            
            $sql = 'CALL `dbgruporac`.`SP_Compras_Cantidad`();';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_COLUMN);

            if ($result === false) {
                throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
            }

            return $result;

        } catch (Exception $e) {
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }

    public function cantidadVentasMes() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`SP_VentasMes_Cantidad`();';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

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

    public function cantidadComprasMes() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`SP_ComprasMes_Cantidad`();';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

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

    public function cantidadModelos() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`SP_Modelos_Cantidad`();';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute();
            
            
            $result = $stmt->fetch(PDO::FETCH_COLUMN);

            if ($result === false) {
                throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
            }

            return $result;

        } catch (Exception $e) {
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }

    public function cantidadEmpleados() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`SP_Empleados_Cantidad`();';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute();
            
            
            $result = $stmt->fetch(PDO::FETCH_COLUMN);

            if ($result === false) {
                throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
            }

            return $result;

        } catch (Exception $e) {
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }

    public function cantidadClientes() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`SP_Clientes_Cantidad`();';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute();
            
            
            $result = $stmt->fetch(PDO::FETCH_COLUMN);

            if ($result === false) {
                throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
            }

            return $result;

        } catch (Exception $e) {
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }

    public function cantidadSedes() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`SP_Sedes_Cantidad`();';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_COLUMN);

            if ($result === false) {
                throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
            }

            return $result;

        } catch (Exception $e) {
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }

    public function top5Empleados() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`SP_Empleados_Top5`();';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

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

    public function top5Marcas() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`SP_Vehiculos_Top5`();';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

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


    public function comprasClientesMes() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`SP_ComprasClientes_Mes`();';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

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

    public function ventasEmpleadosMes() {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`SP_VentasEmpleados_Mes`();';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

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


    public function cantidadComprasFiltro($fecha_inicio, $fecha_fin) {
        global $pdo;
    
        try {
            $sql = 'CALL `dbgruporac`.`SP_ComprasCantidad_FiltroFecha`(?, ?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
    
            $stmt->execute([$fecha_inicio, $fecha_fin]);
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result === false) {
                throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
            }
    
            return $result;
    
        } catch (Exception $e) {
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }
    
    public function cantidadVentasFiltro($fecha_inicio, $fecha_fin) {
        global $pdo;
    
        try {
            $sql = 'CALL `dbgruporac`.`SP_VentasCantidad_FiltroFecha`(?, ?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
    
            $stmt->execute([$fecha_inicio, $fecha_fin]);
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result === false) {
                throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
            }
    
            return $result;
    
        } catch (Exception $e) {
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }
    
    public function cantidadVentasEmpleadosFiltro($fecha_inicio, $fecha_fin) {
        global $pdo;
    
        try {
            $sql = 'CALL `dbgruporac`.`SP_VentasEmpleadosCantidad_FiltroFecha`(?, ?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
    
            $stmt->execute([$fecha_inicio, $fecha_fin]);
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result === false) {
                throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
            }
    
            return $result;
    
        } catch (Exception $e) {
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }
    
    public function cantidadComprasClientesFiltro($fecha_inicio, $fecha_fin) {
        global $pdo;
    
        try {
            $sql = 'CALL `dbgruporac`.`SP_ComprasClientesCantidad_FiltroFecha`(?, ?)';
            $stmt = $pdo->prepare($sql);
            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }
    
            $stmt->execute([$fecha_inicio, $fecha_fin]);
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result === false) {
                throw new Exception('Error al obtener resultados: ' . implode(", ", $stmt->errorInfo()));
            }
    
            return $result;
    
        } catch (Exception $e) {
            throw new Exception('Error al listar: ' . $e->getMessage());
        }
    }
    




}
?>
