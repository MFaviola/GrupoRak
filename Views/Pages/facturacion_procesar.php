<?php
require_once '../Services/VentaService.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ventaService = new VentaService();

    $fechaCreacion = $_POST['fechaCreacion'];
    $empleado = 1; 
    $sede = 1;
    $metodoPago = $_POST['metodoPagoSelect'];
    $descuento = $_POST['descuentoSelect'];
    $cliente = $_POST['Cli_ID'];
    $usuarioCrea = 1; 
    $impId = 1; 

    try {
        $ventaId = $ventaService->insertarVenta($fechaCreacion, $empleado, $metodoPago, $sede, $descuento, $cliente, $impId, $usuarioCrea);
        $_SESSION['mensaje'] = 'Factura creada exitosamente con ID: ' . $ventaId;
        $_SESSION['mensaje_tipo'] = 'success';
    } catch (Exception $e) {
        $_SESSION['mensaje'] = 'Error al crear la factura: ' . $e->getMessage();
        $_SESSION['mensaje_tipo'] = 'danger';
    }

    header('Location: factura.php');
    exit();
}
?>
