
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function generarMenu($conn) {
    $rol_id = $_SESSION['rol'];
    $es_admin = $_SESSION['Usu_Admin'];
    $pantallas = $_SESSION['pantallas'];

    if ($es_admin == 1) { // Verificar si es administrador
        $sql = "SELECT * FROM acce_tbpantallas WHERE Ptl_Estado = 1";
        $stmt = $conn->prepare($sql);
    } else {
        $sql = "SELECT * FROM acce_tbpantallas WHERE Ptl_Identificador IN (" . implode(',', array_fill(0, count($pantallas), '?')) . ") AND Ptl_Estado = 1";
        $stmt = $conn->prepare($sql);
        foreach ($pantallas as $k => $identificador) {
            $stmt->bindValue(($k + 1), $identificador, PDO::PARAM_STR);
        }
    }

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Agrupar pantallas por categoría
    $menu = [
        'Inicio' => [],
        'Dashboards' => [],
        'Reportes' => [],
        'Accesos' => [],
        'Generales' => [],
        'Ventas' => []
    ];

    foreach ($result as $row) {
        switch ($row['Ptl_Descripcion']) {
            case 'Usuarios':
            case 'Roles':
                $menu['Accesos'][] = $row;
                break;
            case 'Compras':
            case 'Ventas':
            case 'Empleados por Ventas':
            case 'Vehiculos por Rangos':
                $menu['Reportes'][] = $row;
                break;
            case 'Empleados':
            case 'Clientes':
            case 'Modelos':
                $menu['Generales'][] = $row;
                break;
            case 'Ventas Vehiculos':
            case 'Compras Vehiculos':
            case 'Vehiculos':
                $menu['Ventas'][] = $row;
                break;
            case 'Dashboards':
                $menu['Dashboards'][] = $row;
                break;
            default:
                $menu['Inicio'][] = $row;
        }
    }

    echo '<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">';
    
    // Menu Items
    echo '<li class="nav-item">';
    echo '<a href="inicio.php" class="nav-link"><i class="fa-solid fa-house"></i><p>Inicio</p></a>';
    echo '</li>';
    
    if (!empty($menu['Dashboards'])) {
        echo '<li class="nav-item">';
        echo '<a href="?Pages=dashboardsInicio" class="nav-link"><i class="fa-solid fa-chart-simple"></i><p>Dashboards</p></a>';
        echo '</li>';
    }

    // Reportes
    if (!empty($menu['Reportes'])) {
        echo '<li class="nav-item" id="EsquemaReportes">';
        echo '<a href="#" class="nav-link" id="LinkReportes"><i class="fa-solid fa-file"></i><p>Reportes<i class="fas fa-angle-left right"></i></p></a>';
        echo '<ul class="nav nav-treeview">';
        foreach ($menu['Reportes'] as $item) {
            echo '<li class="nav-item"><a href="?Pages=' . $item['Ptl_Identificador'] . '" class="nav-link"><i class="far fa-circle nav-icon"></i><p>' . $item['Ptl_Descripcion'] . '</p></a></li>';
        }
        echo '</ul>';
        echo '</li>';
    }

    // Accesos
    if (!empty($menu['Accesos'])) {
        echo '<li class="nav-item" id="EsquemaAcceso">';
        echo '<a href="#" class="nav-link" id="LinkAcceso"><i class="fa-solid fa-lock"></i><p>Accesos<i class="fas fa-angle-left right"></i></p></a>';
        echo '<ul class="nav nav-treeview">';
        foreach ($menu['Accesos'] as $item) {
            echo '<li class="nav-item"><a href="?Pages=' . $item['Ptl_Identificador'] . '" class="nav-link"><i class="far fa-circle nav-icon"></i><p>' . $item['Ptl_Descripcion'] . '</p></a></li>';
        }
        echo '</ul>';
        echo '</li>';
    }

    // Generales
    if (!empty($menu['Generales'])) {
        echo '<li class="nav-item" id="EsquemaGeneral">';
        echo '<a href="#" class="nav-link" id="LinkGeneral"><i class="fa-solid fa-globe"></i><p>Generales<i class="fas fa-angle-left right"></i></p></a>';
        echo '<ul class="nav nav-treeview">';
        foreach ($menu['Generales'] as $item) {
            echo '<li class="nav-item"><a href="?Pages=' . $item['Ptl_Identificador'] . '" class="nav-link"><i class="far fa-circle nav-icon"></i><p>' . $item['Ptl_Descripcion'] . '</p></a></li>';
        }
        echo '</ul>';
        echo '</li>';
    }

    // Ventas
    if (!empty($menu['Ventas'])) {
        echo '<li class="nav-item" id="EsquemaVentas">';
        echo '<a href="#" class="nav-link" id="LinkVentas"><i class="fa-solid fa-bag-shopping"></i><p>Ventas<i class="fas fa-angle-left right"></i></p></a>';
        echo '<ul class="nav nav-treeview">';
        foreach ($menu['Ventas'] as $item) {
            echo '<li class="nav-item"><a href="?Pages=' . $item['Ptl_Identificador'] . '" class="nav-link"><i class="far fa-circle nav-icon"></i><p>' . $item['Ptl_Descripcion'] . '</p></a></li>';
        }
        echo '</ul>';
        echo '</li>';
    }

    echo '<li class="nav-item">';
    echo '<a href="cerrar-sesion.php" class="close-sesion nav-link text-center" style="color:white; background-color: red; margin-top:350px;"><p>Cerrar sesión</p></a>';
    echo '</li>';
    
    echo '</ul>';
}


?>
<!-- jQuery -->
<script src="../Views/Resources/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../Views/Resources/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../Views/Resources/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../Views/Resources/dist/js/demo.js"></script>
