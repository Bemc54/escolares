<?php
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    // Crea una instancia de la hoja de cálculo
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Encabezados basados en tu tabla de empleados
    $encabezados = ['Nombre', 'Telefono', 'Correo', 'Grado de Estudio', 'Carrera', 'Status del Alumno (Tienes que poner el valor numerico que corresponden a los estatus):'];
    
    // Agrega los encabezados a la hoja de Excel
    $columna = 'A';
    foreach ($encabezados as $encabezado) {
        $sheet->setCellValue($columna . '2', $encabezado);
        // Configura el estilo del encabezado
        $style = $sheet->getStyle($columna . '2');
        $style->getFont()->setBold(true); // Establece la negrita
        $style->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $style->getFill()->getStartColor()->setARGB('CCCCCC'); // Establece el color de fondo gris claro
        $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $columna++;
    }

    // Agrega los datos de los empleados
    $row = 3;

    $titulo = 'Antes de cargar este archivo a la base de datos, elimina esta fila y la de los encabezados, la primera fila es un ejemplo de como se debe llenar la información, eliminala o sustituyela';
    $sheet->setCellValue('A1', $titulo);
    // Combina las celdas
    $sheet->mergeCells('A1:U1');
    // Obtiene el estilo y configura la alineación
    $diseño = $sheet->getStyle('A1');
    // Configura la alineación
    $diseño->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    // Configura el estilo de relleno (fondo negro)
    $diseño->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
    $diseño->getFill()->getStartColor()->setARGB('000000'); // Negro
    // Configura el estilo de la fuente (blanco y tamaño 20px)
    $diseño->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE));
    $diseño->getFont()->setSize(14);

    $columna = 'A';
    foreach ($encabezados as $encabezado) {
        $valor = '';  // Inicializa el valor en blanco por defecto
        // Realiza el mapeo de encabezados a las columnas correspondientes en la base de datos
        switch ($encabezado) {
            case 'Nombre':
                $valor = 'Nombre completo del Alumno';
                break;
            case 'Telefono':
                $valor = 'Numero de telefono del Alumno';
                break;                    
            case 'Correo':
                $valor = 'Correo Electrónico del Alumno';
                break;
            case 'Grado de Estudio':
                $valor = 'Grado de Estudio del Alumno';
                break;
            case 'Carrera':
                $valor = 'En caso de ser un Alumno de Carrera Sabado y Domingo o Escolarizado, sino dejelo en Blanco';
                break;
            case 'Status del Alumno (Tienes que poner el valor numerico que corresponden a los estatus):':
                $valor = '1: Activo | 2: Baja Temporal | 3: Baja Definitiva | 4: Egresado';
                break;
        }
        $sheet->setCellValue($columna . $row, $valor);
        $columna++;
    }
    $row++;
    $fileName = 'Machote_Alumnos.xlsx';
    $anuncio = 'Machote de Alumnos';
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
                window.location.href = "download.php?file='.urldecode($fileName).'";
                Swal.fire({
                    icon: "success",
                    title: "'.$anuncio.' en Excel guardado en Descargas",
                    showConfirmButton: true,
                }).then(function() {
                    window.location.href = "index.php?seccion=listaAlumnos";
                });
            </script>';
    } catch (Exception $e) {
        die('Error al guardar el archivo: ' . $e->getMessage());
    }
?>