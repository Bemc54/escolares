<?php
require 'vendor/autoload.php';
use Mpdf\Mpdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

// Obtener el ID del ingreso
$idIngreso = ($_GET['id'] ?: $_GET['idpa']);

// Consultar los datos del ingreso
$ingreso = ControladorIngresos::consultaTodoIngresoID($idIngreso);

if ($ingreso) {
    $idPago = $ingreso[0][2]; // Ajusta los índices según tu estructura de datos
    $nombreAlumno = $ingreso[0][10];
    $concepto = $ingreso[0][3];
    $monto = $ingreso[0][4];
    $fechaPago = $ingreso[0][5];
    $cobrador = $ingreso[0][6];
    $metodo = $ingreso[0][7];
    $comentario = $ingreso[0][8];
    $idAlumno = $ingreso[0][1];
    $grado = $ingreso[0][11];
    $idPageIng= $idPago.$idIngreso;

    $mpdf = new Mpdf();

    // Generar código de barras
    $generator = new BarcodeGeneratorPNG();
    $barcode = base64_encode($generator->getBarcode($idPageIng, $generator::TYPE_CODE_128));

    $html = '
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            .ticket-container {
                width: 70%;
                max-width: 600px;
                margin: 0 auto;
                border: 1px solid #ccc;
                padding: 20px;
                border-radius: 10px;
                background-color: #f9f9f9;
            }
            .ticket-header {
                text-align: center;
                margin-bottom: 10px;
            }
            .ticket-header h1 {
                margin: 0;
                font-size: 24px;
                color: #333;
            }
            .ticket-details {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            .ticket-details th, .ticket-details td {
                border: 1px solid #ccc;
                padding: 8px;
                text-align: left;
            }
            .ticket-details th {
                background-color: #f2f2f2;
            }
            .ticket-footer {
                text-align: center;
                font-size: 12px;
                color: #777;
            }
            .barcode {
                text-align: center;
                margin-top: 20px;
            }
        </style>

        <div class="ticket-container">
            <div class="ticket-header">
                <h1>Ticket de Pago</h1>
            </div>
            <div style="text-align: center; margin-bottom: 20px">
                <img style="width: 25%;" src="./images/logo.png">
            </div>
            <table class="ticket-details">
                <tr>
                    <th>ID Pago</th>
                    <td>' . $idPago . '</td>
                </tr>
                <tr>
                    <th>Nombre del Alumno</th>
                    <td>' . $nombreAlumno . '</td>
                </tr>
                <tr>
                    <th>Grado</th>
                    <td>' . $grado . '</td>
                </tr>
                <tr>
                    <th>Concepto</th>
                    <td>' . $concepto . '</td>
                </tr>
                <tr>
                    <th>Monto</th>
                    <td>$ ' . $monto . '</td>
                </tr>
                <tr>
                    <th>Fecha de Pago</th>
                    <td>' . $fechaPago . '</td>
                </tr>
                <tr>
                    <th>Cobrador</th>
                    <td>' . $cobrador . '</td>
                </tr>
                <tr>
                    <th>Método de Pago</th>
                    <td>' . $metodo . '</td>
                </tr>
                <tr>
                    <th>Comentarios</th>
                    <td>' . $comentario . '</td>
                </tr>
            </table>
            <div class="ticket-footer">
                <p>___________________________</p>
                <p>Firma</p>
            </div>
            <div class="barcode">
                <img src="data:image/png;base64,' . $barcode . '" alt="Código de Barras">
            </div>
            <div class="ticket-footer">
                <p>Gracias por su aportacion.</p>
            </div>
        </div>
    ';
    $mpdf->WriteHTML($html);
    $nameFile = 'ticket_' . $nombreAlumno . '.pdf';
    $pdfPath = './'.$nameFile;

    $mpdf->Output($pdfPath, 'F');

    echo '
        <script>
            window.location.href = "download.php?file=' .urlencode($nameFile). '";
            Swal.fire({
                icon: "success",
                title: "Ticket Generado",
                showConfirmButton: true
            }).then(function() {
                window.location.href = "index.php?seccion=pagosAlumno&id=' . $idAlumno . '";
            });
        </script>
    ';
} else {
    echo "No se encontraron datos para el ingreso proporcionado.";
}
?>
