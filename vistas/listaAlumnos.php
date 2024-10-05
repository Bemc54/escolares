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
        $carreras = ControladorCarreras::consultaCarreras();
        $opciones = '';
        foreach ($carreras as $row => $item) {
            $opciones .= '<option value="'.$item[1].'">'.$item[1].'</option>';
        }
        $heads = '
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Grado de Estudio</th>
            <th>Carrera (Solo Universitarios)</th>
            <th>Status del Alumno</th>
            <th>Fun</th>
        ';
        $btnAgregar = '';
        if (isset($_SESSION['rol'])) {
            $lista = ControladorAlumnos::consultaAlumnos();
            if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'Conta' || $_SESSION['rol'] == 'sx') {
                $btnAgregar = '
                    <button id="add" style="bottom: 3rem; right: 3rem;" class="btn btn-outline-light border border-light" onclick="registrarAlumno()"><span class="fa fa-user-graduate"></span></button>
                        <script>
                            function registrarAlumno() {
                                Swal.fire({
                                    title: "Registrar Alumno",
                                    html: `
                                        <form class="p-3 card bg-info" action="" method="post" enctype="multipart/form-data">
                                            <div style="margin-bottom:2%">
                                                <div class="form-floating mb-1">
                                                    <input autocomplete="off" class="form-control" type="text" id="floatingInput" name="nombre" required placeholder="">
                                                    <label for="floatingInput">Nombre</label>
                                                </div>
                                                <div class="form-floating mb-1">
                                                    <input autocomplete="off" class="form-control" type="number" id="floatingInput" name="telefono" required placeholder="">
                                                    <label for="floatingInput">Telefono</label>
                                                </div>
                                                <div class="form-floating mb-1">
                                                    <input autocomplete="off" class="form-control" type="mail" id="floatingInput" name="correo" required placeholder="">
                                                    <label for="floatingInput">Correo</label>
                                                </div>
                                                <div class="form-floating mb-1">
                                                    <input value="1" autocomplete="off" class="form-control" type="text" id="floatingInput" name="status" required placeholder="" readonly>
                                                    <label for="floatingInput">Status</label>
                                                </div>
                                                <div class="form-floating mb-1">
                                                    <select class="form-select" aria-label="Default select example" name="grado_estudio" required>
                                                        <option selected value="Bachillerato">Bachillerato</option>
                                                        <option value="Carrera Semi-Escolarizada">Carrera Semi-Escolarizada</option>
                                                        <option value="Carrera Escolarizada">Carrera Escolarizada</option>
                                                        <option value="Maestria">Maestria</option>
                                                        <option value="Examen Unico">Examen Unico</option>
                                                    </select>
                                                    <label for="floatingInput">Nivel de Estudio</label>
                                                </div>
                                                <div class="form-floating mb-1">
                                                    <select class="form-select" aria-label="Default select example" name="carrera">
                                                        <option selected value="">Seleccione</option>
                                                        '.$opciones.'
                                                    </select>
                                                    <label for="floatingInput">En caso de Escolarizado o Sabado y Domingo</label>
                                                </div>
                                            </div>
                                            <button type="submit" name="guardar" class="btn btn-success"><i class="fa-solid fa-cloud-arrow-up"></i> Guardar Alumno</button>
                                        </form>
                                    `,
                                    showCloseButton: true,
                                    showConfirmButton: false,
                                    width: 600,
                                });
                            }
                        </script>
                ';
                if ($_SESSION['rol'] == 'sx') {
                    $btnAgregar .= '
                        <button id="add" style="bottom: 3rem; left: 3rem; width: 15rem;" class="btn btn-outline-light border border-light" onclick="addCarrera()">Agregar Carrera</button>
                    ';
                }
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
            if ($item[6] == '1') {
                $item[6] = '<span class="badge bg-success">Activo</span>';
            } elseif ($item[6] == '2') {
                $item[6] = '<span class="badge bg-warning">Baja Temporal</span>';
            } elseif ($item[6] == '3') {
                $item[6] = '<span class="badge bg-danger">Baja Definitiva</span>';
            } elseif ($item[6] == '4') {
                $item[6] = '<span class="badge bg-primary">Egresado</span>';
            } 
            $contenido = '
                    <td><a href="index.php?seccion=pagosAlumno&id='.$item[0].'">' . $item[1] . '</td>
                    <td>' . $item[2] . '</td>
                    <td>' . $item[3] . '</td>
                    <td>' . $item[4] . '</td>
                    <td>' . $item[5] . '</td>
                    <td>' . $item[6] . '</td>
                    ' . $acciones . '
            ';
            echo '
                <tr>
                    '. $contenido .'
                </tr>
            ';
        }
        $contenido = '
        </tbody>
    </table>
</div>
        ';
    }
?>
