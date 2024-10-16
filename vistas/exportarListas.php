<?php
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
    // Crea una instancia de la hoja de cálculo
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    // Recupera los datos de los empleados
    

    if (isset($_GET['alumnosExcel'])) {
        $lista = ControladorAlumnos::ConsultaAlumnos();
        // Encabezados basados en tu tabla de empleados
        $encabezados = ['No.', 'Nombre', 'IDPago', 'Telefono', 'Correo', 'Grado de estudio', 'Carrera', 'Status'];
        // Agrega los datos de los empleados
        
        $row = 2;
        foreach ($lista as $item) {
            if ($item[6] == 1) {
                $item[6] = 'Activo';
                $columna = 'A';
                foreach ($encabezados as $encabezado) {
                    $valor = '';  // Inicializa el valor en blanco por defecto
                    // Realiza el mapeo de encabezados a las columnas correspondientes en la base de datos
                    switch ($encabezado) {
                        case 'No.':
                            $valor = $item[0];  // Ajusta el índice según la estructura de tu array
                            break;
                        case 'Nombre':
                            $valor = $item[1];
                            break;
                        case 'IDPago':
                            $valor = $item[7];
                            break;                    
                        case 'Telefono':
                            $valor = $item[2];
                            break;
                        case 'Correo':
                            $valor = $item[3];
                            break;
                        case 'Grado de estudio':
                            $valor = ' '.$item[4];
                            break;
                        case 'Carrera':
                            $valor = $item[5];
                            break;
                        case 'Status':
                            $valor = $item[6];
                            break;
                    }
                    $sheet->setCellValue($columna . $row, $valor);
                    $columna++;
                }
                $row++;
            }
        }
        $fileName = 'Lista_Alumnos.xlsx';
        $anuncio = 'Lista de Alumnos en Excel';
        $columna = 'A';
        foreach ($encabezados as $encabezado) {
            $sheet->setCellValue($columna . '1', $encabezado);
            // Configura el estilo del encabezado
            $style = $sheet->getStyle($columna . '1');
            $style->getFont()->setBold(true); // Establece la negrita
            $style->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $style->getFill()->getStartColor()->setARGB('CCCCCC'); // Establece el color de fondo gris claro
            $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            
            $columna++;
        }
        // Genera el nombre de archivo y la ruta completa para el archivo Excel
        $xlsxFilePath = './'. $fileName;
        // Crea un objeto para escribir en el archivo Excel
        $writer = new Xlsx($spreadsheet);

        try {
            // Guarda el archivo en el servidor
            $writer->save($xlsxFilePath);

            // Mostrar un mensaje SweetAlert
            echo '
                <script type="text/javascript">
                window.location.href = "download.php?file=' . urlencode($fileName) . '";
                    Swal.fire({
                        icon: "success",
                        title: "'.$anuncio.' guardada en Descargas",
                        showConfirmButton: true,
                    }).then(function() {
                        window.location.href = "index.php?seccion=listaAlumnos";
                    });
                </script>';
        } catch (Exception $e) {
            die('Error al guardar el archivo: ' . $e->getMessage());
        }
    } elseif (isset($_GET['ingresosExcel'])) {
        $lista = ControladorIngresos::ConsultaIngresos();
        // Encabezados basados en tu tabla de empleados
        $encabezados = ['Folio', 'Alumno', 'IDPago', 'Grado de estudio', 'Concepto', 'Monto', 'Fecha de Pago', 'Metodo de Pago', 'Comentario', 'Cobrador'];
        // Agrega los datos de los empleados
        $row = 2;
        foreach ($lista as $item) {
            $columna = 'A';
            foreach ($encabezados as $encabezado) {
                $valor = '';  // Inicializa el valor en blanco por defecto

                // Realiza el mapeo de encabezados a las columnas correspondientes en la base de datos
                switch ($encabezado) {
                    case 'Folio':
                        $valor = $item[0];  // Ajusta el índice según la estructura de tu array
                        break;
                    case 'Alumno':
                        $valor = $item[10];
                        break;
                    case 'IDPago':
                        $valor = $item[15];
                        break;
                    case 'Grado de estudio':
                        $valor = $item[13];
                        break;
                    case 'Concepto':
                        $valor = $item[3];
                        break;
                    case 'Monto':
                        $valor = $item[4];
                        break;
                    case 'Fecha de Pago':
                        $valor = $item[5];
                        break;
                    case 'Metodo de Pago':
                        $valor = $item[7];
                        break;
                    case 'Comentario':
                        $valor = $item[8];
                        break;
                    case 'Cobrador':
                        $valor = $item[6];
                        break;
                }
                $sheet->setCellValue($columna . $row, $valor);
                $columna++;
            }
            $row++;
        }
        $fileName = 'Lista_ingresos.xlsx';
        $anuncio = 'Lista de Ingresos en Excel';
        // Agrega los encabezados a la hoja de Excel
        $columna = 'A';
        foreach ($encabezados as $encabezado) {
            $sheet->setCellValue($columna . '1', $encabezado);
            // Configura el estilo del encabezado
            $style = $sheet->getStyle($columna . '1');
            $style->getFont()->setBold(true); // Establece la negrita
            $style->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $style->getFill()->getStartColor()->setARGB('CCCCCC'); // Establece el color de fondo gris claro
            $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            
            $columna++;
        }
        // Genera el nombre de archivo y la ruta completa para el archivo Excel
        $xlsxFilePath = './'. $fileName;
        // Crea un objeto para escribir en el archivo Excel
        $writer = new Xlsx($spreadsheet);

        try {
            // Guarda el archivo en el servidor
            $writer->save($xlsxFilePath);

            // Mostrar un mensaje SweetAlert
            echo '
                <script type="text/javascript">
                window.location.href = "download.php?file=' . urlencode($fileName) . '";
                    Swal.fire({
                        icon: "success",
                        title: "'.$anuncio.' guardada en Descargas",
                        showConfirmButton: true,
                    }).then(function() {
                        window.location.href = "index.php?seccion=listaIngresos";
                    });
                </script>';
        } catch (Exception $e) {
            die('Error al guardar el archivo: ' . $e->getMessage());
        }
    } elseif (isset($_GET['adeudosExcel'])) {
        // Obtener los meses de inicio y fin
        $conseguirMes = \IntlDateFormatter::create(
            \Locale::getDefault(),
            \IntlDateFormatter::NONE,
            \IntlDateFormatter::NONE,
            \date_default_timezone_get(),
            \IntlDateFormatter::GREGORIAN,
            'MMMM'
        );
        $fechaReal = \IntlDateFormatter::create(
            \Locale::getDefault(),
            \IntlDateFormatter::NONE,
            \IntlDateFormatter::NONE,
            \date_default_timezone_get(),
            \IntlDateFormatter::GREGORIAN,
            'dd/MM/yyyy'
        );

        // Convertir fechas de entrada a formato de timestamp con strtotime
        $inicio = strtotime(str_replace('/', '-', $_GET['inicio']));
        $fechafinal = $_GET['final'];
        $finale = strtotime(str_replace('/', '-', $fechafinal));

        // Revisar si strtotime devolvió un valor válido
        if ($inicio === false || $finale === false) {
            echo "Error: No se pudo procesar la fecha correctamente.";
            return;
        }

        // Formatear las fechas a los formatos locales
        $inicioLocal = $fechaReal->format($inicio);
        $finaleLocal = $fechaReal->format($finale);

        // Obtener los meses de inicio y fin
        $mesInicio = strtolower($conseguirMes->format($inicio)); // Mes en minúscula para comparación
        $mesFin = strtolower($conseguirMes->format($finale));

        // Meses relevantes para cada grado de estudio
        $mesesReinscripcionCarrera = ['septiembre', 'enero', 'abril'];
        $mesesCarreraPsicologia = ['enero', 'julio'];
        $mesesReinscripcionBachillerato = ['enero', 'abril', 'julio', 'octubre'];

        // Consultar los datos del ingreso
        $ingreso = ControladorAlumnos::consultaAlumnosAdeudos($inicioLocal, $finaleLocal);

        if ($ingreso) {
            // Crear un nuevo archivo Excel
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Encabezado del reporte
            $fechas = $mesInicio . ' - ' . $mesFin;
            $sheet->setCellValue('A1', 'Adeudos de Alumnos del Periodo: ' . $fechas);
            $sheet->mergeCells('A1:F1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
            
            // Generar código de barras
            $generator = new BarcodeGeneratorPNG();
            $barcode = base64_encode($generator->getBarcode($fechas, $generator::TYPE_CODE_128));

            // Agregar logo de la escuela en la celda
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName('Logo');
            $drawing->setPath('./images/logo.png'); // Ruta del logo
            $drawing->setHeight(80); // Altura del logo
            $drawing->setCoordinates('B3'); // Posición del logo
            $drawing->setWorksheet($sheet);

            // Encabezado de la tabla
            $sheet->setCellValue('A5', 'Alumno')
                ->setCellValue('B5', 'Teléfono')
                ->setCellValue('C5', 'Correo')
                ->setCellValue('D5', 'Grado de Estudio')
                ->setCellValue('E5', 'Carrera')
                ->setCellValue('F5', 'Adeudos');
            $sheet->getStyle('A5:F5')->getFont()->setBold(true);

            // Agregar datos de los alumnos
            $rowIndex = 6;
            foreach ($ingreso as $row => $item) {
                if ($item[6] == '1') { // Verificar el estatus
                    $grado_estudio = $item[4];
                    $ingresos_adeudados = explode(',', $item[7]);
                    $adeudos_filtrados = [];

                    foreach ($ingresos_adeudados as $adeudo) {
                        if ($adeudo == 'Mensualidad') {
                            $adeudos_filtrados[] = $adeudo;
                        }

                        // Validación de meses y grados para reinscripción
                        if ($adeudo == 'Reinscripcion') {
                            if ($grado_estudio == 'Carrera Semi-Escolarizada' || $grado_estudio == 'Carrera Escolarizada' || $grado_estudio == 'maestria') {
                                // Validación de meses para carrera
                                if (in_array($mesInicio, $mesesReinscripcionCarrera) || in_array($mesFin, $mesesReinscripcionCarrera)) {
                                    $adeudos_filtrados[] = $adeudo;
                                    if ($item[5] == 'Psicologia' && in_array($mesInicio, $mesesCarreraPsicologia)) {
                                        $adeudos_filtrados[] = $adeudo;
                                    }
                                }
                            } elseif ($grado_estudio == 'Bachillerato') {
                                // Validación de meses para bachillerato
                                if (in_array($mesInicio, $mesesReinscripcionBachillerato) || in_array($mesFin, $mesesReinscripcionBachillerato)) {
                                    $adeudos_filtrados[] = $adeudo;
                                }
                            }
                        }
                    }

                    if (!empty($adeudos_filtrados)) {
                        $sheet->setCellValue('A' . $rowIndex, $item[1])
                            ->setCellValue('B' . $rowIndex, $item[2])
                            ->setCellValue('C' . $rowIndex, $item[3])
                            ->setCellValue('D' . $rowIndex, $item[4])
                            ->setCellValue('E' . $rowIndex, $item[5])
                            ->setCellValue('F' . $rowIndex, implode(', ', $adeudos_filtrados));
                        $rowIndex++;
                    }
                }
            }

            // Guardar el archivo Excel
            $iniciom = date('d_m_Y', strtotime(str_replace('/', '-', $_GET['inicio'])));
            $finalem = date('d_m_Y', strtotime(str_replace('/', '-', $_GET['final'])));
            $nameFile = 'Adeudos_de_alumnos_' . $iniciom . '_a_' . $finalem . '.xlsx';
            $excelPath = './'.$nameFile;
            
            $writer = new Xlsx($spreadsheet);
            $writer->save($excelPath);

            // Redirigir para la descarga del archivo Excel
            echo '
                <script>
                    window.location.href = "download.php?file=' .urlencode($nameFile). '";
                    Swal.fire({
                        icon: "success",
                        title: "Adeudos pendientes generados en Excel",
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
    }
?>