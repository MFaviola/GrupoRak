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
            $stmt = $pdo->prepare("CALL acce_SP_Usuarios_InicioSesion(:usuario, :contrasena)");
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':contrasena', $contrasena);
            $stmt->execute();

            $user = $stmt->fetch();

            if ($user) {
                $_SESSION['usuario'] = $user['Usu_Usua'];
                $_SESSION['nombre_completo'] = $user['Usu_Nombrecompleto'];
                $_SESSION['rol'] = $user['Admin'];
                header("Location: ./Template.Controller.php");
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
