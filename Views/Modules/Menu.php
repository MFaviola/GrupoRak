<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-image: url(https://i.pinimg.com/736x/95/62/3d/95623dc132235138cfa75403d63aeef3.jpg);">
    <!-- Brand Logo -->
    <a href="../Views/Resources/index3.html" class="brand-link" style="background-color:#000">
      <img src="../Views/Resources\dist\img\logroRac.jpg" alt="grupo rac" class="brand-image img-circle elevation-3" style="opacity: .8">
      <!-- <span class="brand-text" style="font-weight:bold; font-size:17px; color:white; font-family: Arial, sans-serif;">GRUPO<span class="brand-text" style="font-weight:bold; color:#cb0002; font-family: Arial, sans-serif;">RAC</span></span> -->
      <img src="../Views/Resources\dist\img\letras.png" class="ml-2" style="height:20px; width:100px; opacity: .8" alt="">
    </a>
    
    <?php
      if (session_status() == PHP_SESSION_NONE) {
          session_start();
      }
      include '../config.php'; // Asegúrate de incluir la conexión a la base de datos.
      include '../Services/MenuService.php';
      $nombreCompleto = isset($_SESSION['nombre_completo']) ? $_SESSION['nombre_completo'] : 'Usuario invitado';
    ?>
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../Views/Resources/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block" style="color:white">
            <?php echo htmlspecialchars($nombreCompleto); ?>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <?php generarMenu($pdo); ?>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>