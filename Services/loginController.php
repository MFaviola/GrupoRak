<?php
session_start();
require_once __DIR__ . '/../config.php';

class ControllerLogin {
    public function __construct() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->login();
        } else {
            $this->showLoginForm();
        }
    }

    public function showLoginForm() {
        header("Location: ../index.php");
        exit();
    }

    public function login() {
        global $pdo;

        $usuario = $_POST['email'];
        $contrasena = $_POST['password'];

        if (empty($usuario) || empty($contrasena)) {
            $_SESSION['error_message'] = "Usuario y contraseña son requeridos.";
            header("Location: ../index.php");
            exit();
        }

        try {
            $stmt = $pdo->prepare("CALL sp_usuarios_iniciosesion(:usuario, :contrasena)");
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':contrasena', $contrasena);
            $stmt->execute();

            $pantallas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($pantallas)) {
                $_SESSION['ID'] = $pantallas[0]['Usu_ID'];
                $_SESSION['usuario'] = $pantallas[0]['Usu_Usua'];
                $_SESSION['nombre_completo'] = $pantallas[0]['Usu_Nombrecompleto'];
                $_SESSION['rol'] = $pantallas[0]['Rol_Id'];
                $_SESSION['Usu_Admin'] = $pantallas[0]['Usu_Admin'];
                $_SESSION['pantallas'] = array_column($pantallas, 'Ptl_Identificador');

                header("Location: ../Services/Template.Service.php?Pages=dashboardsInicio ");
                exit();
            } else {
                $_SESSION['error_message'] = "Usuario o contraseña incorrectos.";
                header("Location: ../index.php");
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Error al iniciar sesión: " . $e->getMessage();
            header("Location: ../index.php");
            exit();
        }
    }
}

new ControllerLogin();
?>