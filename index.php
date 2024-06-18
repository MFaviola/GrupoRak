<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="Views/Resources/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Views/Resources/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="Views/Resources/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="Views/Resources/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="Views/Resources/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body>
  <div class="wrapper">
    <div class="login-card">
      <div class="login-aside flex justify-content-center align-items-center">
        <div>
          <div class="icon-wrapper mt-3">
            <img src="Views/Resources/dist/img/logroRac.jpg" alt="Home Icon" id="logo">
          </div>
        </div>
      </div>
      <div class="login-aside-container">
        <div class="login-container d-none" id="login-container">
          <?php
          session_start();
          $error_message = "";
          if (isset($_SESSION['error_message'])) {
            $error_message = $_SESSION['error_message'];
            unset($_SESSION['error_message']);
          }
          ?>
          <form id="quickForm" method="POST" action="Services/loginController.php">
          <h3 style="text-align:center; font-weight:bold; font-family: Arial, sans-serif;">Iniciar Sesión</h3>
            <div class="card-body" style="width:135%">
              <div class="form-group">
                <label for="exampleInputEmail1">Usuario</label>
                <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Usuario">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Contraseña</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                  placeholder="Contraseña">
              </div>
              <div class="form-group mb-0">
              <div class="custom-control custom-checkbox" style="font-size: 12px; display: flex; justify-content: space-between; align-items: center;">
              <input style="margin-right: 5px;" type="checkbox" name="terms" class="custom-control-input mb-4" id="exampleCheck1">
              <label style="margin-right: auto;" class="custom-control-label" for="exampleCheck1">Recordar</label> 
              <a href="Views/Pages/solicitar_restauracion.php" style="font-size: 14px; margin-left: 10px;">Restablecer contraseña</a>
          </div>
                
              </div>
              <button type="submit" class="btn btn-dark btn-block mt-3"><i class="fa-solid fa-right-to-bracket"></i>ㅤIniciar Sesión</button>
              <div class="form-group">
                <label class="text-danger" id="error_message"><?php echo $error_message; ?></label>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <style>
    .d-none {
      display: none;
    }

    body,
    html {
      height: 100%;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f4f6f9;
      background-image: url('https://c.wallhere.com/photos/f9/12/1920x1080_px_car_Dodge_Dodge_Challenger_SRT_Red_Cars-1095872.jpg!d');
      background-size: cover; 
      background-repeat: no-repeat; 
      background-attachment: fixed;
    }

    .wrapper {
      z-index: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
    }

    .login-card {
      z-index: 1;
      width: 800px;
      height: 500px;
      display: flex;
      position: relative;
    }

    @keyframes unfoldAside {
      from {
        transform: scaleY(0);
      }

      to {
        transform: scaleY(1);
      }
    }

    .login-aside {
      z-index: 2;
      background-color: #000;
      width: 35%;
      border-radius: 10px;
      box-shadow: rgba(0, 0, 0, 0.25) 10px 14px 28px, rgba(0, 0, 0, 0.22) 8px 10px 10px;
      animation: unfoldAside 1s ease-out forwards;
      position: relative;
    }

    @keyframes unfoldAsideContainer {
      from {
        transform: scaleX(0);
      }

      to {
        transform: scaleX(1);
        width: 65%;
      }
    }

    .login-aside-container {
      display: flex;
      align-items: center;
      width: 0%;
      transform-origin: left;
      animation: unfoldAsideContainer 0.5s ease-out forwards;
      animation-delay: 1.2s;
      position: relative;
    }

    .login-container {
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 4;
      transition: width 2s, opacity 1s ease-out;
      width: 100%;
      height: 95%;
      background: #f1f1f1;
      border-top-right-radius: 15px;
      border-bottom-right-radius: 15px;
      box-shadow: rgba(0, 0, 0, 0.25) 10px 14px 28px, rgba(0, 0, 0, 0.22) 8px 10px 10px;
      opacity: 0;

    }

    .login-container.show {
      opacity: 1;
    }

    .login-content {
      padding-top: 14%;
      padding-bottom: 14%;
      padding-right: 20%;
      padding-left: 20%;
    }

    .icon-wrapper {
      width: 250px;
      border-radius: 10px;
    }

    #logo {
      width: 100%;
      border-radius: 10px;
    }

    .sinopsis {
      padding: 20px;
      color: #ecf0f1;
      font-size: smaller;
    }

    .btn-block {
      width: 100%;
      display: block;
    }
  </style>
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      setTimeout(() => {
        document.getElementById('login-container').classList.remove('d-none');
        setTimeout(() => {
          document.getElementById('login-container').classList.add('show');
        }, 50); // Delay to allow transition to apply
      }, 1800); // Delay before showing the form (1.2 seconds)
    });
  </script>
</body>

</html>








<?php
    //include "/Controllers/loginController.php";
    // include "Controllers/Template.Controller.php";

    // $template = new ControllerTemplate;
    //$template = new ControllerLogin;

    // $template -> ControllerTemplate();
    //$template -> ControllerLogin();
?>