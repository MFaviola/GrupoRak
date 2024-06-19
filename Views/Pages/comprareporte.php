<?php
// require_once './Services/ReportesService.php';
// require_once '../Services/ReportesService.php';
// function isAjax() {
//     return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
// }
// if (isAjax() && isset($_GET['month']) && isset($_GET['year'])) {
//     $month = intval($_GET['month']);
//     $year = intval($_GET['year']);

//     try {
//         $reportesServices = new ReportesServices();
//         $result = $reportesServices->ReporteCompras1($month, $year);
//         header('Content-Type: application/json');
//         echo json_encode($result);
//     } catch (Exception $e) {
//         header('Content-Type: application/json');
//         echo json_encode(['error' => $e->getMessage()]);
//     }
//     exit();
// }
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title text-center py-2">Reporte de Compras</h2>
            <div class="form-row justify-content-center mt-4">
                <div class="col-md-4 mb-3">
                    <label for="ddlMonth">Mes</label>
                    <select id="ddlMonth" class="form-control">
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
                </div>
                <div class="col-md-4 mb-3">
                    <label for="ddlYear">Año</label>
                    <select id="ddlYear" class="form-control">
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                    </select>
                </div>
            </div>
            <div class="text-center">
                <button onclick="generateReport()" class="btn btn-danger">Generar Reporte</button>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="collapse" id="pdfPreview">
        <div class="card card-body">
            <embed id="pdfEmbed" src="" type="application/pdf" width="100%" height="600px" />
        </div>
    </div>
</div>

<script>
    async function generateReport() {
        const month = document.getElementById('ddlMonth').value;
        const year = document.getElementById('ddlYear').value;

        try {
            $.ajax({
                url: '../Services/obtener_reporte.php',
                type: 'GET',
                data: { filterMonth: month, filterYear: year },
                success: function(response) {
                    console.log('respuesta: ' + response.data)
                    const data = JSON.parse(response);

                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();

                    // Título del reporte
                    doc.setFontSize(18);
                    doc.setTextColor(255, 255, 255); // Blanco
                    doc.setFillColor(220, 0, 0); // Rojo
                    doc.rect(10, 10, 190, 10, 'F'); // Fondo rojo para el título
                    doc.text('Reporte de Compras', 105, 17, null, null, 'center');

                    doc.setFontSize(12);
                doc.setTextColor(255, 255, 255); // Blanco
                doc.setFillColor(0, 0, 0); // Negro
                doc.rect(10, 30, 190, 10, 'F'); // Fondo negro para el encabezado de la tabla

                // Ajusta el ancho de la columna de ID
                doc.rect(10, 30, 15, 10, 'F'); // ID
                doc.text('ID', 12, 37); // Texto ID
                doc.text('Fecha', 30, 37); // Ajusta la posición del texto Fecha
                doc.text('Cliente', 60, 37); // Ajusta la posición del texto Cliente
                doc.text('Cantidad', 90, 37); // Ajusta la posición del texto Cantidad
                doc.text('Precio', 120, 37); // Ajusta la posición del texto Precio
                doc.text('Subtotal', 150, 37); // Ajusta la posición del texto Subtotal
                doc.text('Total', 180, 37); // Ajusta la posición del texto Total

                let yPosition = 47;
                doc.setTextColor(0, 0, 0); // Negro

                // Líneas de la tabla
                doc.setLineWidth(0.1);
                data.forEach(row => {
                    doc.line(10, yPosition - 7, 200, yPosition - 7); // Línea horizontal superior
                    doc.line(10, yPosition + 3, 200, yPosition + 3); // Línea horizontal inferior
                    doc.line(10, yPosition - 7, 10, yPosition + 3); // Línea vertical izquierda
                    doc.line(25, yPosition - 7, 25, yPosition + 3); // Línea vertical después de ID Compra
                    doc.line(55, yPosition - 7, 55, yPosition + 3); // Línea vertical después de Fecha
                    doc.line(85, yPosition - 7, 85, yPosition + 3); // Línea vertical después de Cliente
                    doc.line(115, yPosition - 7, 115, yPosition + 3); // Línea vertical después de Cantidad
                    doc.line(145, yPosition - 7, 145, yPosition + 3); // Línea vertical después de Precio Compra
                    doc.line(175, yPosition - 7, 175, yPosition + 3); // Línea vertical después de Subtotal
                    doc.line(200, yPosition - 7, 200, yPosition + 3); // Línea vertical derecha

                    // Contenido de la tabla
                    const date = new Date(row.Com_Fecha).toLocaleDateString();
                    doc.text(`${row.Com_ID}`, 12, yPosition);
                    doc.text(`${date}`, 30, yPosition);
                    doc.text(`${row.cli_nombre}`, 60, yPosition);
                    doc.text(`${row.Cdt_Cantidad}`, 90, yPosition);
                    doc.text(`L. ${row.Cdt_PrecioCompra}`, 120, yPosition);
                    doc.text(`L. ${row.subtotal}`, 150, yPosition);
                    doc.text(`L.${row.total}`, 180, yPosition);
                    yPosition += 10;
                    if (yPosition > 280) { // Salto de página si la posición y supera un límite
                        doc.addPage();
                        yPosition = 20;
                    }
                });

                    const pdfDataUri = doc.output('datauristring');
                    document.getElementById('pdfEmbed').setAttribute('src', pdfDataUri);

                    $('#pdfPreview').collapse('show');
                }
            });
        } catch (error) {
            console.error('Error generating report:', error.message);
        }
    }
</script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
