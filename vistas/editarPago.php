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
        $editar = ControladorPagos::consultaPagoID($id);
        foreach($editar as $row => $item){}
        $editar = new ControladorPagos;
        $editar -> editarPago();
        
        echo '
            <form class="p-4 col-5 card bg-info" action="" method="post" enctype="multipart/form-data">
                <div style="margin-bottom:2%">
                <input type="hidden" name="id" value="'.$item[0].'">
                    <div class="form-floating mb-1">
                        <select class="form-select" aria-label="Default select example" name="concepto" required>
                            <option selected value="'.$item[1].'">Dato Guardado: '.$item[1].'</option>
                            <option value="Examen Unico">Examen Unico</option>
                            <option value="Mensualidad">Mensualidad</option>
                            <option value="Inscripcion">Inscripcion</option>
                            <option value="Reinscripcion">Reinscripcion</option>
                        </select>
                        <label for="floatingInput">Concepto</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input autocomplete="off" class="form-control" value="'.$item[2].'" type="text" id="floatingInput" name="monto" required placeholder="">
                        <label for="floatingInput">Monto</label>
                    </div>
                    <div class="form-floating mb-1">
                        <select class="form-select" aria-label="Default select example" name="tipo_alumno" required>
                            <option selected value="'.$item[3].'">Dato Guardado: '.$item[3].'</option>
                            <option value="Todos">Todos</option>
                            <option value="Preparatoria">Preparatoria</option>
                            <option value="Universidad">Universidad</option>
                            <option value="Post-Grado">Post-Grado</option>
                        </select>
                        <label for="floatingInput">Tipo de Alumno que lo debe Pagar</label>
                    </div>
                </div>
                <button type="submit" name="editar" class="btn btn-danger"><i class="fa-solid fa-floppy-disk"></i> Guardar Cambios</button>
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