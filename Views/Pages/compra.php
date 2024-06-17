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
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title text-center">Reporte de Compras</h2>
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
                <button onclick="generateReport()" class="btn btn-primary">Generar Reporte</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

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

            doc.text('Reporte de Compras', 10, 10);
            let yPosition = 20;
                    console.log('datos: ' + data)
                    
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

