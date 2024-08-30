<?php
require 'vendor/autoload.php';
use Mpdf\Mpdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

if (isset($_POST['imprimir'])) {
    $hoy = $_POST['dia'];
    $hoy = date('d/m/Y', strtotime($hoy));
} else {
    $hoy = date('d/m/Y');
}
// Consultar los datos del ingreso
$ingreso = ControladorIngresos::consultaIngresosDia($hoy);
var_dump($ingreso);

if ($ingreso) {
    $mpdf = new Mpdf();

    // Generar código de barras
    $generator = new BarcodeGeneratorPNG();
    $barcode = base64_encode($generator->getBarcode($hoy, $generator::TYPE_CODE_128));
    $totalMonto = 0;

    $html = '
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            .ticket-container {
                width: 90%;
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
                font-size: 14px;
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
                <h1>Corte del Día '. $hoy .'</h1>
            </div>
            <div style="text-align: center; margin-bottom: 20px">
                <img style="width: 25%;" src="./images/logo.png">
            </div>
            <table class="ticket-details">
                <thead>
                    <tr>
                        <th>Alumno</th>
                        <th>Concepto</th>
                        <th>Monto</th>
                        <th>Grado de Estudio</th>
                        <th>Carrera</th>
                        <th>Metodo</th>
                        <th>Comentario</th>
                        <th>Cobrador</th>
                    </tr>
                </thead>
                <tbody>
    ';

    foreach ($ingreso as $row => $item) {
        $nombre = $item[6];
        $comentario = $item[3];
        $concepto = $item[5];
        $monto = number_format($item[4], 2);
        $grado = $item[9];
        $carrera = $item[10];
        $metodo = $item[1];
        $cobrador = $item[2];
        $html .= '
            <tr>
                <td>' . $nombre . '</td>
                <td>' . $concepto . '</td>
                <td>$' . $monto . '</td>
                <td>' . $grado . '</td>
                <td>' . $carrera . '</td>
                <td>' . $metodo . '</td>
                <td>' . $comentario . '</td>
                <td>' . $cobrador .'</td>
            </tr>
        ';
        $totalMonto += $item[4];
    }

    $html .= '
                </tbody>
            </table>
            <p style="text-align: center;">Total: <b>$' . number_format($totalMonto, 2) . '</b></p>
            <div class="ticket-footer">
                <p>___________________________</p>
                <p>Firma</p>
            </div>
            <div class="barcode">
                <img src="data:image/png;base64,' . $barcode . '">
            </div>
        </div>
    ';
    $mpdf->WriteHTML($html);
    if (isset($_POST['imprimir'])) {
        $hoy = $_POST['dia'];
        $hoyGB = date('d_m_Y', strtotime($hoy));
    } else {
        $hoyGB = date('d_m_Y');
    }
    $nameFile = 'corte_' . $hoyGB . '.pdf';
    $pdfPath = './'.$nameFile;

    $mpdf->Output($pdfPath, 'F');

    echo '
        <script>
            window.location.href = "download.php?file=' .urlencode($nameFile). '";
            Swal.fire({
                icon: "success",
                title: "Corte de Caja Realizado",
                showConfirmButton: true
            }).then(function() {
                window.location.href = "index.php?seccion=listaIngresos";
            });
        </script>
    ';
} else {
    echo '
        <script type="text/javascript">
            Swal.fire({
                icon: "warning",
                title: "No tines datos para realizar el corte de caja",
                showConfirmButton: true
            }).then(function() {
                window.location.href = "index.php?seccion=listaIngresos";
            });
        </script>
    ';
}
?>
