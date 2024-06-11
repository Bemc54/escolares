<div class="col-10 list">
    <?php
    if (!isset($_SESSION['rol'])) {
        echo '
            <script type="text/javascript">
                Swal.fire({
                    icon: "error",
                    title: "No tienes Permiso para entrar",
                    text: "Necesitas Iniciar Sesión para entrar a cualquier parte del sistema",
                    showConfirmButton: true,
                }).then(function() {
                    window.location.href = "index.php";
                });
            </script>
        ';
    } else {
        $conseguirMes = \IntlDateFormatter::create(
            \Locale::getDefault(),
            \IntlDateFormatter::NONE,
            \IntlDateFormatter::NONE,
            \date_default_timezone_get(),
            \IntlDateFormatter::GREGORIAN,
            'MMMM'
        );
        $fechaLocal = \IntlDateFormatter::create(
            \Locale::getDefault(),
            \IntlDateFormatter::NONE,
            \IntlDateFormatter::NONE,
            \date_default_timezone_get(),
            \IntlDateFormatter::GREGORIAN,
            'MM/dd/yyyy'
        );
        $fechaReal = \IntlDateFormatter::create(
            \Locale::getDefault(),
            \IntlDateFormatter::NONE,
            \IntlDateFormatter::NONE,
            \date_default_timezone_get(),
            \IntlDateFormatter::GREGORIAN,
            'dd/MM/yyyy'
        );
        $heads = '
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Grado de Estudio</th>
            <th>Carrera (Solo Universitarios)</th>
            <th>Adeudos</th>
        ';
        $inicio = $fechaLocal->format(strtotime($_POST['inicio']));
        $fin = $fechaLocal->format(strtotime($_POST['fin']));
        $inicioLocal = $fechaReal->format(strtotime($_POST['inicio']));
        $finLocal = $fechaReal->format(strtotime($_POST['fin']));
        $mesInicio = $conseguirMes->format(strtotime($inicio));
        $mesFin = $conseguirMes->format(strtotime($fin));
        
        // Meses relevantes para cada grado de estudio
        $mesesReinscripcionCarrera = ['septiembre', 'enero', 'abril'];
        $mesesReinscripcionBachillerato = ['enero', 'abril', 'julio', 'octubre'];

        if (isset($_SESSION['rol'])) {
            $lista = ControladorAlumnos::consultaAlumnosAdeudos($inicio, $fin);
            echo '
                <div style="display: flex; align-items: start; justify-content: space-between; margin-bottom: -1%">
                    <button class="btn btn-icon btn-outline-warning" style="background: yellow" onclick="invitadosInformacion()"><i class="fa-solid fa-question fa-flip"></i></button>
                    <a class="btn btn-danger" href="index.php?seccion=reporteAdeudos&inicio=' . $inicioLocal . '&fin=' . $finLocal . '"><span class="fa fa-file-pdf"></span> Generar PDF</a>
                </div>
                <h4 class="text-center"><span class="badge bg-primary"><i class="fa-solid fa-sack-dollar"></i> Lista de Adeudos</span></h4>
                <table class="table table-secondary table-bordered table-striped table-hover" id="empleados">
                    <thead>
                        <tr class="table-dark">
                            '.$heads.'
                        </tr>
                    </thead>
                    <tbody>
            ';
        } else {
            echo '
                <script type="text/javascript">
                    Swal.fire({
                        icon: "info",
                        title: "No tienes Permiso para entrar",
                        text: "Tú nivel de Usuario no tiene permitido entrar aquí",
                        showConfirmButton: true,
                    }).then(function() {
                        window.location.href = "index.php?seccion=listaAnuncios";
                    });
                </script>
            ';
        }
        foreach ($lista as $item) {
            $grado_estudio = $item[4];
            $ingresos_adeudados = explode(',', $item[6]);
            $adeudos_filtrados = [];

            foreach ($ingresos_adeudados as $adeudo) {
                if ($adeudo == 'Reinscripcion') {
                    if ($grado_estudio == 'Carrera Semi-Escolarizada' || $grado_estudio == 'Carrera Escolarizada' || $grado_estudio == 'maestria') {
                        if (in_array($mesInicio, $mesesReinscripcionCarrera) || in_array($mesFin, $mesesReinscripcionCarrera)) {
                            $adeudos_filtrados[] = $adeudo;
                        }
                    } elseif ($grado_estudio == 'Bachillerato') {
                        if (in_array($mesInicio, $mesesReinscripcionBachillerato) || in_array($mesFin, $mesesReinscripcionBachillerato)) {
                            $adeudos_filtrados[] = $adeudo;
                        }
                    }
                } else {
                    $adeudos_filtrados[] = $adeudo;
                }
            }

            if (!empty($adeudos_filtrados)) {
                $contenido = '
                        <td><a href="index.php?seccion=pagosAlumno&id='.$item[0].'">' . $item[1] . '</td>
                        <td>' . $item[2] . '</td>
                        <td>' . $item[3] . '</td>
                        <td>' . $item[4] . '</td>
                        <td>' . $item[5] . '</td>
                        <td>' . implode(', ', $adeudos_filtrados) . '</td>
                ';
                echo '
                    <tr>
                        '. $contenido .'
                    </tr>
                ';
            }
        }
        echo '
            </tbody>
            </table>
        ';
    }
    ?>
</div>
