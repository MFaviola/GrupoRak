<?php
require_once 'Controllers/ReportesServices/ReporteSServices.php';

header('Content-Type: application/json');

if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = intval($_GET['month']);
    $year = intval($_GET['year']);

    try {
        $reportesServices = new ReportesServices();
        $result = $reportesServices->ReporteCompras($month, $year);
        echo json_encode($result);

    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid parameters']);
}
?>
    <style>
        .card {
            width: 400px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .ddl-container {
            margin-top: 20px;
        }
        .ddl {
            margin: 10px;
            padding: 5px;
            width: 150px;
        }
    </style>
    <div class="card">
        <h2>Reporte de Compras</h2>
        <div class="ddl-container">
            <select id="ddlMonth" class="ddl">
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            <select id="ddlYear" class="ddl">
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
            </select>
        </div>
        <button onclick="generateReport()">Generar Reporte</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        async function generateReport() {
            const month = document.getElementById('ddlMonth').value;
            const year = document.getElementById('ddlYear').value;
            try {
                const response = await fetch(`reporte_compras.php?month=${month}&year=${year}`);
                const data = await response.json();

                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                doc.text('Reporte de Compras', 10, 10);
                let yPosition = 20;

                data.forEach(row => {
                    doc.text(`ID Compra: ${row.Com_ID}`, 10, yPosition);
                    doc.text(`Fecha: ${row.Com_Fecha}`, 10, yPosition + 10);
                    doc.text(`Cliente: ${row.cli_nombre}`, 10, yPosition + 20);
                    doc.text(`Cantidad: ${row.Cdt_Cantidad}`, 10, yPosition + 30);
                    doc.text(`Precio Compra: ${row.Cdt_PrecioCompra}`, 10, yPosition + 40);
                    doc.text(`Subtotal: ${row.subtotal}`, 10, yPosition + 50);
                    doc.text(`Total: ${row.total}`, 10, yPosition + 60);
                    yPosition += 70;
                });

                doc.save('reporte_compras.pdf');
            } catch (error) {
                console.error('Error generating report:', error);
            }
        }
    </script>

