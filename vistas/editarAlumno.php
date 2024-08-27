<?php
    if (!isset($_SESSION['rol'])){
        echo '
            <script type="text/javascript">
                Swal.fire({
                    icon: "info",
                    title: "No tienes Permiso para entrar",
                    text: "Necesitas Iniciar Sesión para entrar a cualquier parte del sistema",
                    showConfirmButton: true,
                }).then(function() {
                    window.location.href = "index.php";
                });
            </script>
        ';
    } elseif (isset($_SESSION['rol']) && $_SESSION['rol'] == 'sx' || $_SESSION['rol'] == 'Admin') {
        $id = $_GET['id'];
        $editar = ControladorAlumnos::consultaAlumnoID($id);
        foreach($editar as $row => $item){}
        $editar = new ControladorAlumnos;
        $editar -> editarAlumno();
        $nombre = 'nombre';
        $telefono = 'telefono';
        $correo = 'correo';
        $btn = 'editar';
        if ($item[6] == '1') {
            $item[6] = 'Activo';
        } elseif ($item[6] == '2') {
            $item[6] = 'Baja Temporal';
        } elseif ($item[6] == '3') {
            $item[6] = 'Baja Definitiva';
        } elseif ($item[6] == '4') {
            $item[6] = 'Egresado';
        }
        
        echo '
            <form class="card p-4 col-5 bg-secondary" action="" method="post" enctype="multipart/form-data">
                <div calss="mb-2">
                <input type="hidden" name="id" value="'.$item[0].'">
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control" type="text" id="floatingInput" name="'.$nombre.'" value="'.$item[1].'">
                        <label for="floatingInput">Nombre</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input autocomplete="off" class="form-control" type="number" id="floatingInput" name="'.$telefono.'" value="'.$item[2].'">
                        <label for="floatingInput">Telefono</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input class="form-control" type="mail" id="floatinInput" name="'.$correo.'" value="'.$item[3].'" required placeholder="">
                        <label for="floatingInput">Correo</label>
                    </div>
                    <div class="form-floating mb-2">
                        <select class="form-select" aria-label="Default select example" name="grado_estudio" required>
                            <option selected value="'.$item[4].'">Valor Actual: '.$item[4].'</option>
                            <option value="Bachillerato">Bachillerato</option>
                            <option value="Carrera Semi-Escolarizada">Carrera Semi-Escolarizada</option>
                            <option value="Carrera Escolarizada">Carrera Escolarizada</option>
                            <option value="Maestria">Maestria</option>
                            <option value="Examen Unico">Examen Unico</option>
                        </select>
                        <label for="floatingInput">Nivel de Estudio</label>
                    </div>
                    <div class="form-floating mb-2">
                        <select class="form-select" aria-label="Default select example" name="carrera">
                            <option selected value="'.$item[5].'">Valor Actual: '.$item[5].'</option>
                            <option value="Psicologia">Psicologia</option>
                            <option value="Derecho">Derecho</option>
                            <option value="Ingenieria Industrial">Ingenieria Industrial</option>
                            <option value="Trabajo Social">Trabajo Social</option>
                            <option value="Psicopedagogia">Psicopedagogia</option>
                            <option value="Ingles">Ingles</option>
                            <option value="Proteccion Civil">Proteccion Civil</option>
                        </select>
                        <label for="floatingInput">Carreras (Solo universidad)</label>
                    </div>
                    <div class="form-floating mb-2 border border-danger">
                        <select class="form-select" aria-label="Default select example" name="status">
                            <option selected value="'.$item[6].'">Valor Actual: '.$item[6].'</option>
                            <option value="1">Activo</option>
                            <option value="2">Baja Temporal</option>
                            <option value="3">Baja Definitiva</option>
                            <option value="4">Egresado</option>
                        </select>
                        <label for="floatingInput">Status del Alumno</label>
                    </div>
                </div>
                <button class="btn btn-danger" type="submit" name="'.$btn.'"><i class="fa-regular fa-floppy-disk"></i> Guardar Cambios</button>
            </form>
        ';
    } else {
        echo '
            <script type="text/javascript">
                Swal.fire({
                    icon: "info",
                    title: "No tienes Permiso para entrar",
                    text: "Tu nivel de Usuario no tiene permitido entrar aquí",
                    showConfirmButton: true,
                }).then(function() {
                    window.location.href = "index.php";
                });
            </script>
        ';
    }
?>