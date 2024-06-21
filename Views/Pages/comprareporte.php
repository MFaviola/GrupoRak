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
            <div class="text-center mb-4">
                <h1 class="card-title1" style="font-weight:bold; font-size: 1.8em;">Reporte de compras</h1>
            </div>
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
            <div class="form-row justify-content-center mt-3">
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
                const doc = new jsPDF({
                    orientation: 'portrait',
                    unit: 'px',
                    format: 'letter'
                });
                const img = new Image();
                img.src = '../Views/Resources/dist/img/logroRac.jpg';

                const addHeader = () => {
                    drawPolygonBackground(doc);
                    const imgX = 20;
                    const imgY = 14;
                    const imgWidth = 44; // Reducido el tamaño del logo
                    const imgHeight = 44; // Reducido el tamaño del logo
                    const cornerRadius = 10;

                    // Dibujar la sombra
                    const shadowOffset = 5;
                    doc.setFillColor(150, 150, 150); // Color de la sombra
                    doc.roundedRect(imgX + shadowOffset, imgY + shadowOffset, imgWidth, imgHeight, cornerRadius, cornerRadius, 'F');

                    // Dibujar el rectángulo para la imagen
                    drawRoundedRect(doc, imgX, imgY, imgWidth, imgHeight, cornerRadius, [214, 39, 0]);
                    doc.addImage(img, 'PNG', imgX, imgY, imgWidth, imgHeight);

                    // Agregar el texto del encabezado
                    doc.setTextColor(0, 0, 0);
                    doc.setFontSize(24); // Reducido el tamaño del título
                    doc.setFont('helvetica', 'bold');
                    doc.text('REPORTE DE COMPRAS', 133, 54, { align: 'left' });
                };


                const addFooter = (pageNumber, pageCount) => {
                    const pageWidth = doc.internal.pageSize.getWidth();
                    const pageHeight = doc.internal.pageSize.getHeight();
                    doc.setFillColor(214, 39, 0); // Rojo
                    doc.rect(0, pageHeight - 20, pageWidth, 20, 'F'); // Fondo rojo para el pie de página que cubre todo el ancho
                    doc.setFontSize(10);
                    doc.setTextColor(255, 255, 255); // Blanco
                    doc.text(`Usuario: 'Prueba'`, 10, pageHeight - 7);
                    doc.text(`Fecha: ${new Date().toLocaleDateString()}`, 150, pageHeight - 7);
                    doc.text(`Página ${pageNumber} de ${pageCount}`, pageWidth - 60, pageHeight - 7);
                };

                const cuerpoConNumeros = data.map((row, index) => {
                    const date = new Date(row.Com_Fecha).toLocaleDateString();
                    return [
                        index + 1,
                        date,
                        row.cli_nombre,
                        row.Cdt_Cantidad,
                        `L. ${row.Cdt_PrecioCompra}`,
                        `L. ${row.subtotal}`,
                        `L. ${row.total}`
                    ];
                });

                doc.autoTable({
                    head: [['N.', 'Fecha', 'Cliente', 'Cantidad', 'Precio Compra', 'Subtotal', 'Total']],
                    body: cuerpoConNumeros,
                    startY: 80,
                    theme: 'grid',
                    styles: {
                        fontSize: 12,
                        cellPadding: 5,
                        textColor: [0, 0, 0],
                        valign: 'middle',
                        halign: 'center'
                    },
                    headStyles: {
                        fillColor: [0, 0, 0],
                        textColor: [255, 255, 255],
                        fontStyle: 'bold'
                    },
                    alternateRowStyles: {
                        fillColor: [240, 240, 240]
                    },
                    didDrawPage: (data) => {
                        addHeader();
                        const pageCount = doc.getNumberOfPages();
                        addFooter(data.pageNumber, pageCount);
                    },
                    margin: { top: 80 }
                });

                const pdfDataUri = doc.output('datauristring');
                document.getElementById('pdfEmbed').setAttribute('src', pdfDataUri);

                $('#pdfPreview').collapse('show');
                $("#insertarEncabezado").hide();
            }
        });
    } catch (error) {
        console.error('Error generating report:', error.message);
    }
}

// Función para dibujar el fondo de polígono
function drawPolygonBackground(doc) {
    const width = doc.internal.pageSize.width;
    const height = 50;
    const x = 0;
    const y = 0;

    const points = [
        [x, y],
        [x + width, y],
        [x + width, y + height],
        [x, y + height]
    ];

    doc.setFillColor(214, 39, 0);
    doc.lines(points, x, y, [1, 1], 'F');
}

// Función para dibujar un rectángulo con esquinas redondeadas
function drawRoundedRect(doc, x, y, width, height, radius, color) {
    doc.setFillColor(...color);
    doc.roundedRect(x, y, width, height, radius, radius, 'F');
}
</script>



<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

