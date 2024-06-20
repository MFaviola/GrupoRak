<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../config.php';

$usuario_id = $_SESSION['ID'];
$rol_id = $_SESSION['rol'];
$es_admin = $_SESSION['Usu_Admin'];
$url_actual = isset($_GET['Pages']) ? $_GET['Pages'] : '';
$pantallas = $_SESSION['pantallas'];

error_log('Usuario ID: ' . $usuario_id);
error_log('Rol ID: ' . $rol_id);
error_log('Es Admin: ' . $es_admin);
error_log('URL Actual: ' . $url_actual);
error_log('Pantallas Permitidas: ' . implode(', ', $pantallas));

if ($es_admin == 1) {
    // Los administradores tienen acceso a todas las pantallas
    $sql = "SELECT * FROM acce_tbpantallas WHERE Ptl_Identificador = :url_actual AND Ptl_Estado = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':url_actual', $url_actual, PDO::PARAM_STR);
    error_log('Consulta SQL para admin: ' . $sql);
} else {
    // Los usuarios con roles específicos
    if (!in_array($url_actual, $pantallas)) {
        // Loguear si la página solicitada no está permitida
        error_log('Acceso denegado. La página no está en las pantallas permitidas: ' . $url_actual);
        //header("Location: ../index.php");
        exit();
    }
    $sql = "SELECT * FROM acce_tbpantallas p
            JOIN acce_tbpantallas_porroles pr ON p.Ptl_Id = pr.Ptl_Id
            WHERE pr.Rol_Id = :rol_id AND p.Ptl_Identificador = :url_actual AND p.Ptl_Estado = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':rol_id', $rol_id, PDO::PARAM_INT);
    $stmt->bindValue(':url_actual', $url_actual, PDO::PARAM_STR);
    error_log('Consulta SQL para rol específico: ' . $sql);
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
error_log('Resultado de la consulta: ' . json_encode($result));

if (count($result) == 0) {
    error_log('Acceso denegado. No se encontraron resultados para la consulta.');
    //header("Location: ../index.php");
    exit();
}
?>
