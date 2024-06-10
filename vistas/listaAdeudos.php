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
        $heads = '
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Grado de Estudio</th>
            <th>Carrera (Solo Universitarios)</th>
            <th>Adeudos</th>
        ';
        $inicio = date('d/m/Y', strtotime($_POST['inicio']));
        $fin = date('d/m/Y', strtotime($_POST['fin']));
        if (isset($_SESSION['rol'])) {
            $lista = ControladorAlumnos::consultaAlumnosAdeudos($inicio, $fin);
            echo '
                <div style="display: flex; align-items: start; justify-content: space-between; margin-bottom: -1%">
                    <button class="btn btn-icon btn-outline-warning" style="background: yellow" onclick="invitadosInformacion()"><i class="fa-solid fa-question fa-flip"></i></button>
                    <a class="btn btn-danger" href="index.php?seccion=reporteAdeudos&inicio=' . $inicio . '&fin=' . $fin . '"><span class="fa fa-file-pdf"></span> Generar PDF</a>
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
            $contenido = '
                    <td><a href="index.php?seccion=pagosAlumno&id='.$item[0].'">' . $item[1] . '</td>
                    <td>' . $item[2] . '</td>
                    <td>' . $item[3] . '</td>
                    <td>' . $item[4] . '</td>
                    <td>' . $item[5] . '</td>
                    <td>' . $item[6] . '</td>
            ';
            echo '
                <tr>
                    '. $contenido .'
                </tr>
            ';
        }
        echo '
            </tbody>
            </table>
        ';
    }
    ?>
</div>
