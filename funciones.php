<?php
require 'config.php';

function agregarCodigoVerificacion($codigo, $userId) {
    global $pdo;
    $stmt = $pdo->prepare("CALL SP_AgregarCodigoVerificacion(?, ?)");
    $stmt->execute([$codigo, $userId]);
}

function mostrarCodigoVerificacion($codigo) {
    global $pdo;
    $stmt = $pdo->prepare("CALL SP_MostrarCodigoVerificacion(?)");
    $stmt->execute([$codigo]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function usuarioReestablecer($codigo, $password, $fechaModificacion) {
    global $pdo;
    $stmt = $pdo->prepare("CALL SP_Usuario_Reestablecer(?, ?, ?)");
    $stmt->execute([$codigo, $password, $fechaModificacion]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function usuariosEnviarCorreo($correoUsuario) {
    global $pdo;
    $stmt = $pdo->prepare("CALL SP_Usuarios_EnviarCorreo(?)");
    $stmt->execute([$correoUsuario]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
