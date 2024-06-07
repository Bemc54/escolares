<?php
    // Verificar si se proporcionó el nombre del archivo en la URL
    if (isset($_GET['file'])) {
        // Ruta del archivo PDF
        $file = __DIR__ . DIRECTORY_SEPARATOR . $_GET['file'];
        // Verificar si el archivo existe
        if (file_exists($file)) {
            // Configurar los encabezados para forzar la descarga del archivo
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            
            // Leer el archivo y enviar su contenido al navegador
            readfile($file);
            unlink($file);
            exit;
        } else {
            // Mostrar un mensaje de error si el archivo no existe
            echo 'El archivo no se encontró en el servidor.';
        }
    } else {
        // Mostrar un mensaje de error si no se proporcionó el nombre del archivo
        echo 'No se proporcionó un nombre de archivo válido.';
    }
?>