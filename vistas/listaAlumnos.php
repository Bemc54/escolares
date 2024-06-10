<div class="col-10 list">
    <?php
    if (!isset($_SESSION['rol'])){
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
    } else{
        $eliminar = new ControladorAlumnos;
        $eliminar -> eliminarAlumno();
        $heads = '
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Grado de Estudio</th>
            <th>Carrera (Solo Universitarios)</th>
            <th>Fun</th>
        ';
        $btnAgregar = '';
        if (isset($_SESSION['rol'])) {
            $lista = ControladorAlumnos::consultaAlumnos();
            if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'Conta' || $_SESSION['rol'] == 'sx') {
                $btnAgregar = '
                    <button id="add" style="bottom: 3rem; right: 3rem;" class="btn btn-outline-light border border-light" onclick="registrarAlumno()"><span class="fa fa-user-graduate"></span></button>
                ';   
            }
            echo '
                <div style="display: flex; align-items: start; justify-content: space-between; margin-bottom: -1%">
                    <button class="btn btn-icon btn-outline-warning" style="background: yellow" onclick="InfoAlumnos()"><i class="fa-solid fa-question fa-flip"></i></button>
                    <button class="btn btn-success" onclick="menuAcciones()"><span class="fa fa-bars"></span> Acciones para Alumnos</button>
                </div>
                '.$btnAgregar.'
                <h4 class="text-center"><span class="badge bg-primary"><i class="fa-solid fa-user-graduate"></i> Lista de Alumnos</span></h4>
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
        foreach ($lista as $row => $item) {
            if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'Conta' || $_SESSION['rol'] == 'sx') {
                $acciones = '
                    <td style="justify-content:center; display: flex;">
                        <a class="btn btn-icon btn-info" href="index.php?seccion=editarAlumno&id=' . $item[0] . '"><i class="fa fa-edit"></i></a>
                    </td>
                ';
            } else {
                $acciones = '<td>No tienes permisos para realizar acciones</td>';
            }
            $contenido = '
                    <td><a href="index.php?seccion=pagosAlumno&id='.$item[0].'">' . $item[1] . '</td>
                    <td>' . $item[2] . '</td>
                    <td>' . $item[3] . '</td>
                    <td>' . $item[4] . '</td>
                    <td>' . $item[5] . '</td>
                    ' . $acciones . '
            ';
            echo '
                <tr>
                    '. $contenido .'
                </tr>
            ';
        }
    }
?>
        </tbody>
    </table>
</div>