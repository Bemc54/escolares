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
                            <option value="Preparatoria">Preparatoria</option>
                            <option value="Universidad">Universidad</option>
                            <option value="Post-Grado">Post-Grado</option>
                        </select>
                        <label for="floatingInput">Nivel de Estudio</label>
                    </div>
                    <div class="form-floating mb-2">
                        <select class="form-select" aria-label="Default select example" name="carrera" required>
                            <option selected value="'.$item[5].'">Valor Actual: '.$item[5].'</option>
                            <option value="Psicologia">Psicologia</option>
                            <option value="Derecho">Derecho</option>
                            <option value="Ingenria Industrial">Ingenria Industrial</option>
                            <option value="Trabajo Social">Trabajo Social</option>
                            <option value="Psicopedagogia">Psicopedagogia</option>
                            <option value="Ingles">Ingles</option>
                        </select>
                        <label for="floatingInput">Carreras (Solo universidad)</label>
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