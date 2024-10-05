<?php
require 'vendor/autoload.php';
use Mpdf\Mpdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

$fechaReal = \IntlDateFormatter::create(
    \Locale::getDefault(),
    \IntlDateFormatter::NONE,
    \IntlDateFormatter::NONE,
    \date_default_timezone_get(),
    \IntlDateFormatter::GREGORIAN,
    'dd/MM/yyyy'
);
var_dump($_GET['inicio'], $_GET['final']);
$fechas = $_GET['inicio'] . ' - ' . $_GET['final'];
// Consultar los datos del ingreso
$ingreso = ControladorAlumnos::consultaAlumnosAdeudos($_GET['inicio'], $_GET['final']);

if ($ingreso) {
    $mpdf = new Mpdf();

    // Generar código de barras
    $generator = new BarcodeGeneratorPNG();
    $barcode = base64_encode($generator->getBarcode($fechas, $generator::TYPE_CODE_128));

    // Meses relevantes para cada grado de estudio
    $mesesReinscripcionCarrera = ['septiembre', 'enero', 'abril'];
    $mesesCarreraPsicologia = ['enero', 'julio'];
    $mesesReinscripcionBachillerato = ['enero', 'abril', 'julio', 'octubre'];

    // Obtener los meses de inicio y fin
    $conseguirMes = \IntlDateFormatter::create(
        \Locale::getDefault(),
        \IntlDateFormatter::NONE,
        \IntlDateFormatter::NONE,
        \date_default_timezone_get(),
        \IntlDateFormatter::GREGORIAN,
        'MMMM'
    );
    $mesInicio = strtolower($conseguirMes->format(strtotime($inicio)));
    $mesFin = strtolower($conseguirMes->format(strtotime($fin)));

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
                <h1>Adeudos de Alumnos del Periodo ' . $fechas . '</h1>
            </div>
            <div style="text-align: center; margin-bottom: 20px">
                <img style="width: 25%;" src="./images/logo.png">
            </div>
            <table class="ticket-details">
                <thead>
                    <tr>
                        <th>Alumno</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Grado de Estudio</th>
                        <th>Carrera</th>
                        <th>Adeudos</th>
                    </tr>
                </thead>
                <tbody>
    ';

    foreach ($ingreso as $row => $item) {
        if ($item[6] == '1') { // Verificar el estatus
            $grado_estudio = $item[4];
            $ingresos_adeudados = explode(',', $item[7]);
            $adeudos_filtrados = [];

            foreach ($ingresos_adeudados as $adeudo) {
                if ($adeudo == 'Mensualidad') {
                    $adeudos_filtrados[] = $adeudo;
                }

                if ($adeudo == 'Reinscripcion') {
                    if ($grado_estudio == 'Carrera Semi-Escolarizada' || $grado_estudio == 'Carrera Escolarizada' || $grado_estudio == 'maestria') {
                        if (in_array($mesInicio, $mesesReinscripcionCarrera) || in_array($mesFin, $mesesReinscripcionCarrera)) {
                            $adeudos_filtrados[] = $adeudo;
                            if ($item[5] == 'Psicologia') {
                                $adeudos_filtrados[] = $adeudo;
                                if (in_array($mesesCarreraPsicologia, $mesesReinscripcionCarrera)) {
                                    $adeudos_filtrados[] = $adeudo;
                                }
                            }
                        }
                    } elseif ($grado_estudio == 'Bachillerato') {
                        if (in_array($mesInicio, $mesesReinscripcionBachillerato) || in_array($mesFin, $mesesReinscripcionBachillerato)) {
                            $adeudos_filtrados[] = $adeudo;
                        }
                    }
                }
            }

            if (!empty($adeudos_filtrados)) {
                $html .= '
                    <tr>
                        <td>' .$item[1]. '</td>
                        <td>' .$item[2]. '</td>
                        <td>' .$item[3]. '</td>
                        <td>' .$item[4]. '</td>
                        <td>' .$item[5]. '</td>
                        <td>' . implode(', ', $adeudos_filtrados) . '</td>
                    </tr>
                ';
            }
        }
    }

    $html .= '
                </tbody>
            </table>
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
    $inicio = date('d_m_Y', strtotime($_GET['inicio']));
    $finale = date('d_m_Y', strtotime($_GET['final']));
    $nameFile = 'Adeudos_de_alumnos_' . $inicio . '_a_' . $finale . '.pdf';
    $pdfPath = './'.$nameFile;

    $mpdf->Output($pdfPath, 'F');

    echo '
        <script>
            window.location.href = "download.php?file=' .urlencode($nameFile). '";
            Swal.fire({
                icon: "success",
                title: "Adeudos pendientes generados",
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
                title: "No tienes datos para realizar el corte de caja",
                showConfirmButton: true
            }).then(function() {
                window.location.href = "index.php?seccion=listaIngresos";
            });
        </script>
    ';
}
?>
