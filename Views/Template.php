
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Blank Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="Views/Resources/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Views/Resources/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-fr-footeixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- HEADER -->
  <?php include "Modules/Header.php"?>
  <!-- /.HEADER -->

  <!-- Main Sidebar Container -->
  <?php include "Modules/Menu.php"?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php 
    if (isset($_GET["Pages"])) {
      if ($_GET["Pages"] == "facturas" || $_GET["Pages"] == "inventario" || $_GET["Pages"] == "cliente") {
        include "Pages/". $_GET["Pages"] . ".php";
      }
    }
  ?>
  

 
  </div>
  <!-- /.content-wrapper -->


  <?php include "Modules/Footer.php"?>
  

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="Views/Resources/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="Views/Resources/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="Views/Resources/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="Views/Resources/dist/js/demo.js"></script>
<!-- DataTables  & Plugins -->
<script src="Views/Resources/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="Views/Resources/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="Views/Resources/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="Views/Resources/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="Views/Resources/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="Views/Resources/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="Views/Resources/plugins/jszip/jszip.min.js"></script>
<script src="Views/Resources/plugins/pdfmake/pdfmake.min.js"></script>
<script src="Views/Resources/plugins/pdfmake/vfs_fonts.js"></script>
<script src="Views/Resources/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="Views/Resources/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="Views/Resources/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
</body>
</html>
