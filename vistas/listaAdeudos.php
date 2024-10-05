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
        
        // Meses relevantes para cada grado de estudio | psicologia en enero y julio dejar solamente las reinscripciones y las mensualidades
        $mesesReinscripcionCarrera = ['septiembre', 'enero', 'abril'];
        $mesesCarreraPsicologia = ['enero', 'julio'];
        $mesesReinscripcionBachillerato = ['enero', 'abril', 'julio', 'octubre'];

        if (isset($_SESSION['rol'])) {
            $lista = ControladorAlumnos::consultaAlumnosAdeudos($inicioLocal, $finLocal);
            echo '
                <div style="display: flex; align-items: start; justify-content: space-between; margin-bottom: -1%">
                    <button class="btn btn-icon btn-outline-warning" style="background: yellow" onclick="invitadosInformacion()"><i class="fa-solid fa-question fa-flip"></i></button>
                    <a class="btn btn-danger" href="index.php?seccion=reporteAdeudos&inicio=' . $inicioLocal . '&final=' . $finLocal . '"><span class="fa fa-file-pdf"></span> Generar PDF</a>
                </div>
                <h4 class="text-center">
                    <span class="badge bg-primary">
                        <i class="fa-solid fa-sack-dollar"></i> Lista de Adeudos<br><br>
                        <span class="badge bg-secondary">Rango de Fechas: ' . $inicioLocal . ' - ' . $finLocal . '</span>
                    </span>
                </h4>
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
            if ($item[6] == '1') { // Verificar el estatus
                $grado_estudio = $item[4];
                $ingresos_adeudados = explode(',', $item[7]);
                $adeudos_filtrados = [];
        
                foreach ($ingresos_adeudados as $adeudo) {
                    // Filtrar "Mensualidad" directamente
                    if ($adeudo == 'Mensualidad') {
                        $adeudos_filtrados[] = $adeudo;
                    }
        
                    // Filtrar "Reinscripción" según el grado de estudio y los meses
                    if ($adeudo == 'Reinscripcion') {
                        if ($grado_estudio == 'Carrera Semi-Escolarizada' || $grado_estudio == 'Carrera Escolarizada') {
                            if (in_array($mesInicio, $mesesReinscripcionCarrera) || in_array($mesFin, $mesesReinscripcionCarrera)) {
                                $adeudos_filtrados[] = $adeudo;
                                if ($item[5] == 'Psicologia') {
                                    if (in_array($mesesCarreraPsicologia, $mesesReinscripcionCarrera)) {
                                        $adeudos_filtrados[] = $adeudo;
                                    }
                                }
                            }
                        } elseif ($grado_estudio == 'Bachillerato' || $grado_estudio == 'Maestria') {
                            if (in_array($mesInicio, $mesesReinscripcionBachillerato) || in_array($mesFin, $mesesReinscripcionBachillerato)) {
                                $adeudos_filtrados[] = $adeudo;
                            }
                        }
                    }
                }
        
                // Mostrar detalles del alumno si hay adeudos filtrados
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
        }        
        echo '
            </tbody>
            </table>
        ';
    }
    ?>
</div>
