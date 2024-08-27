<?php
    require 'vendor/autoload.php'; // Asegúrate de incluir la ubicación correcta de la biblioteca PHPSpreadsheet
    require_once 'modelo/conexion.php'; // Tu archivo de conexión a la base de datos
    use PhpOffice\PhpSpreadsheet\Settings;

    Settings::setlocale('es_ES');

    if (isset($_FILES['alumnos']['name'])) {
        $archivo = $_FILES['alumnos']['tmp_name'];
        // Crear un objeto IOFactory para cargar el archivo Excel
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx'); // Para archivos XLSX

        try {
            $spreadsheet = $reader->load($archivo);
            // Selecciona la hoja de trabajo activa (puedes cambiar '0' por el índice de la hoja que desees)
            $worksheet = $spreadsheet->setActiveSheetIndex(0);
            // Obtén los datos de la hoja
            $data = $worksheet->toArray();
            // Asumimos que la carga es exitosa hasta que se encuentre un name_employ duplicado
            $cargaExitosa = true; 
            // Procesa los datos (por ejemplo, recorre las filas)
            $con = Conexion::conectar(); // Conexión a la base de datos
            // Prepara la consulta preparada
            $stmt = $con->prepare("INSERT INTO alumnos (
                nombre,
                telefono, 
                correo,
                grado_estudio,
                carrera,
                status
                ) VALUES (
                    ?,
                    ?,
                    ?,
                    ?,
                    ?,
                    ?
                )");
            // Bucle para cada fila de datos
            foreach ($data as $row) {
                // Asigna los parámetros de la consulta preparada
                $stmt->bind_param("ssssss",
                    $row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
                // Ejecuta la consulta preparada
                $stmt->execute();
            }
            // Cierra la consulta preparada
            $stmt->close();
            if ($cargaExitosa) {
                echo '
                    <script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "Archivo cargado con Éxito",
                            showConfirmButton: true,
                        }).then(function() {
                            window.location.href = "index.php?seccion=listaAlumnos";
                        });
                    </script>
                ';
            }
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            echo '
            <script type="text/javascript">
                Swal.fire({
                    icon: "error",
                    title: "Error al cargar el archivo",
                    showConfirmButton: true,
                }).then(function() {
                    window.location.href = "index.php?seccion=listaAlumnos";
                });
            </script>
            '.$e->getMessage();
        }
    } else {
        echo '
            <script type="text/javascript">
                Swal.fire({
                    icon: "error",
                    title: "Error al cargar el archivo",
                    showConfirmButton: true,
                }).then(function() {
                    window.location.href = "index.php?seccion=listaAlumnos";
                });
            </script>
        ';
    }
?>
