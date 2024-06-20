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

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h2 class="card-title text-center py-3" style="font-weight:bold">Reporte de Compras</h2>
            <div class="form-row justify-content-center mt-4">
                <div class="col-md-4 mb-3">
                    <label for="startDate">Fecha de Inicio</label>
                    <input type="date" id="startDate" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="endDate">Fecha de Fin</label>
                    <input type="date" id="endDate" class="form-control">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>



<script>
    async function generateReport() {
       
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;

        if (!startDate || !endDate) {
            alert('Por favor, seleccione un rango de fechas válido.');
            return;
        }

        try {
            $.ajax({
                url: '../Services/obtener_reporte.php',
                type: 'GET',
                data: { startDate: startDate, endDate: endDate },
                success: function(response) {
                    const data = JSON.parse(response);
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();

                    const logoBase64 = '../Views/Resources/dist/img/logroRac.jpg';

                    doc.addImage(logoBase64, 'JPEG', 12, 10, 12, 10);

                    // Título del reporte con fondo rojo
                    doc.setFontSize(18);
                    doc.setTextColor(255, 255, 255); // Blanco
                    doc.setFillColor(220, 0, 0); // Rojo
                    doc.rect(10, 25, 190, 10, 'F'); // Fondo rojo para el título
                    doc.text('Reporte de Compras', 105, 32, null, null, 'center');

                    // Tabla con autoTable
                    const tableColumn = ["ID", "Fecha", "Cliente", "Cantidad", "Precio", "Subtotal", "Total"];
                    const tableRows = [];

                    data.forEach(row => {
                        const date = new Date(row.Com_Fecha).toLocaleDateString();
                        const rowData = [
                            row.Com_ID,
                            date,
                            row.cli_nombre,
                            row.Cdt_Cantidad,
                            `L. ${row.Cdt_PrecioCompra}`,
                            `L. ${row.subtotal}`,
                            `L. ${row.total}`
                        ];
                        tableRows.push(rowData);
                    });

                    doc.autoTable({
                        startY: 40,
                        head: [tableColumn],
                        body: tableRows,
                        theme: 'striped',
                        headStyles: { fillColor: [0, 0, 0], textColor: [255, 255, 255] }, // Negro con texto blanco
                        bodyStyles: { fillColor: [255, 255, 255], textColor: [0, 0, 0] }, // Blanco con texto negro
                        alternateRowStyles: { fillColor: [240, 240, 240] }, // Alternar color de fondo
                        styles: { font: 'helvetica', fontSize: 10 },
                        columnStyles: {
                            0: { cellWidth: 20 },
                            1: { cellWidth: 30 },
                            2: { cellWidth: 40 },
                            3: { cellWidth: 25 },
                            4: { cellWidth: 25 },
                            5: { cellWidth: 25 },
                            6: { cellWidth: 25 },
                        },
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

