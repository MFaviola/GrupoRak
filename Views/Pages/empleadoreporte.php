<?php
require_once '../Services/ReportesService.php';
$service = new ReportesServices();

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

try {
    $empleados = $service->listarEmpleado();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>


<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h2 class="card-title text-center py-3" style="font-weight:bold">Reporte de Empleados</h2>
            <div class="form-row justify-content-center mt-4">
                <div class="col-md-4 mb-3">
                    <label for="ddlMonth">Empleados</label>
                    <select class="form-control" name="Empl_DNI" id="Empl_DNI" required>
                                <option value="">--SELECCIONE UN EMPLEADO--</option>
                                <?php foreach ($empleados as $empleado): ?>
                                    <option value="<?php echo $empleado['Empl_DNI']; ?>"><?php echo $empleado['Empl_Nombre'] . ' ' . $empleado['Empl_Apellido']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span style="color:red" class="error-message" id="errorRol"></span>
                            <div class="text-center">
                <button onclick="generateReport()" class="btn btn-danger mt-3">Generar Reporte</button>
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
        
        let isValid = true;
        const ddl = document.getElementById('Empl_DNI');
        if (!ddl.value) {
        document.getElementById('errorRol').textContent = 'El campo es requerido';
        ddl.classList.add('is-invalid');
        isValid = false;
        }

        try {
            $.ajax({
                url: '../Services/obtener_reporte.php',
                type: 'GET',
                data: { DNI: ddl.value },
                success: function(response) {
                    const data = JSON.parse(response);
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();

                    // Agregar logo
                    const logoBase64 = '../Views/Resources/dist/img/logroRac.jpg';

                    doc.addImage(logoBase64, 'JPEG', 12, 10, 12, 10);

                    // Título del reporte con fondo rojo
                    doc.setFontSize(18);
                    doc.setTextColor(255, 255, 255); // Blanco
                    doc.setFillColor(220, 0, 0); // Rojo
                    doc.rect(10, 25, 190, 10, 'F'); // Fondo rojo para el título
                    doc.text('Reporte de Empleados', 105, 32, null, null, 'center');

                    // Tabla con autoTable
                    const tableColumn = ["ID", "Fecha", "Empleado", "Sede", "Subtotal", "Total"];
                    const tableRows = [];

                    data.forEach(row => {
                        const date = new Date(row.Vnt_Fecha).toLocaleDateString();
                        const rowData = [
                            row.Vnt_ID,
                            date,
                            row.emp_nombre,
                            row.Sed_Descripcion,
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

