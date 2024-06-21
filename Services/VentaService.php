<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/GrupoRak/';
require_once $root . 'config.php';

class VentaService {

    public function listar() {
        global $pdo;

        try {
            $sql = 'CALL dbgruporac.sp_Ventas_Listar()';
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




    public function eliminarDetalle($id) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`sp_VentasDetalles_Eliminar`(?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            return "Usuario eliminado correctamente.";
        } catch (Exception $e) {
            throw new Exception('Error al eliminar usuario: ' . $e->getMessage());
        }
    }
    



    public function ListarVentaDetalles($id) {
        global $pdo;
        try {
            $sql = 'CALL `dbgruporac`.`sp_VentasDetalle_Listar`(?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Usar fetchAll para obtener todas las filas
            return $result;
        } catch (Exception $e) {
            throw new Exception('Error al obtener ciudades: ' . $e->getMessage());
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
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            throw new Exception('Error al listar vehículos: ' . $e->getMessage());
        }
    }

    public function buscarClientePorDNI($dni) {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Cliente_BuscarPorDNI`(:dni)';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($result) {
                return $result[0]; // Suponiendo que siempre se devuelve un solo resultado
            } else {
                return null;
            }

        } catch (Exception $e) {
            throw new Exception('Error al buscar cliente por DNI: ' . $e->getMessage());
        }
    }

    public function buscarVehiculoPorPlaca($placa) {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Vehiculos_Listar`()'; // Reutilizamos este procedimiento para obtener todos los vehículos y filtrar por placa
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $vehiculo) {
                if ($vehiculo['Veh_Placa'] === $placa) {
                    return $vehiculo;
                }
            }
            return null;

        } catch (Exception $e) {
            throw new Exception('Error al buscar vehículo por placa: ' . $e->getMessage());
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

    public function eliminarVentaDetalle($vehPlaca) {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Venta_Detalle_Eliminar`(:vehPlaca)';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->bindParam(':vehPlaca', $vehPlaca, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            throw new Exception('Error al eliminar detalle de venta: ' . $e->getMessage());
        }
    }

    public function eliminarVenta($vntId) {
        global $pdo;

        try {
            $sql = 'CALL `dbgruporac`.`sp_Venta_Eliminar`(:vntId)';
            $stmt = $pdo->prepare($sql);

            if ($stmt === false) {
                throw new Exception('Error al preparar la declaración: ' . implode(", ", $pdo->errorInfo()));
            }

            $stmt->bindParam(':vntId', $vntId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            throw new Exception('Error al eliminar venta: ' . $e->getMessage());
        }
    }

    // Manejo de solicitudes AJAX dentro de VentaService.php
    public function handleAjaxRequest() {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'buscarClientePorDNI':
                    if (isset($_POST['dni'])) {
                        $dni = $_POST['dni'];
                        try {
                            $cliente = $this->buscarClientePorDNI($dni);
                            if ($cliente) {
                                echo json_encode(['status' => 'success', 'data' => $cliente]);
                            } else {
                                echo json_encode(['status' => 'error', 'message' => 'Cliente no encontrado']);
                            }
                        } catch (Exception $e) {
                            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                        }
                    }
                    break;
                case 'buscarVehiculoPorPlaca':
                    if (isset($_POST['placa'])) {
                        $placa = $_POST['placa'];
                        try {
                            $vehiculo = $this->buscarVehiculoPorPlaca($placa);
                            if ($vehiculo) {
                                echo json_encode(['status' => 'success', 'data' => $vehiculo]);
                            } else {
                                echo json_encode(['status' => 'error', 'message' => 'Vehículo no encontrado']);
                            }
                        } catch (Exception $e) {
                            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                        }
                    }
                    break;
                case 'insertarVenta':
                    if (isset($_POST['fecha']) && isset($_POST['empId']) && isset($_POST['mpgId']) && isset($_POST['sedId']) && isset($_POST['desId']) && isset($_POST['cliId']) && isset($_POST['impId']) && isset($_POST['usuIdCre'])) {
                        try {
                            $ventaId = $this->insertarVenta($_POST['fecha'], $_POST['empId'], $_POST['mpgId'], $_POST['sedId'], $_POST['desId'], $_POST['cliId'], $_POST['impId'], $_POST['usuIdCre']);
                            echo json_encode(['status' => 'success', 'data' => ['Vnt_ID' => $ventaId]]);
                        } catch (Exception $e) {
                            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                        }
                    }
                    break;
                case 'insertarVentaDetalle':
                    if (isset($_POST['vntId']) && isset($_POST['precioVenta']) && isset($_POST['vehPlaca']) && isset($_POST['usuIdCre'])) {
                        try {
                            $this->insertarVentaDetalle($_POST['vntId'], $_POST['precioVenta'], $_POST['vehPlaca'], $_POST['usuIdCre']);
                            echo json_encode(['status' => 'success']);
                        } catch (Exception $e) {
                            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                        }
                    }
                    break;
                case 'eliminarVentaDetalle':
                    if (isset($_POST['vehPlaca'])) {
                        try {
                            $this->eliminarVentaDetalle($_POST['vehPlaca']);
                            echo json_encode(['status' => 'success']);
                        } catch (Exception $e) {
                            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                        }
                    }
                    break;
                case 'eliminarVenta':
                    if (isset($_POST['vntId'])) {
                        try {
                            $this->eliminarVenta($_POST['vntId']);
                            echo json_encode(['status' => 'success']);
                        } catch (Exception $e) {
                            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                        }
                    }
                    break;
                // Otros casos para diferentes acciones...
            }
        }
    }










    
}

// Ejecutar la lógica de manejo de AJAX si es una solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ventaService = new VentaService();
    $ventaService->handleAjaxRequest();
}
