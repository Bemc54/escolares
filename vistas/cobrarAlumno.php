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
        $id = $_GET['idal'];
        $gradoAl = $_GET['grade'];
        $eliminar = new ControladorPagos;
        $eliminar -> eliminarPago();
        $heads = '
            <th>Concepto</th>
            <th>Monto</th>
            <th>Tipo de Alumno Aceptado</th>
            <th>Fun</th>
        ';
        $btnAgregar = '';
        if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'sx') {
            if ($_SESSION['rol'] == 'sx') {
                $lista = ControladorPagos::consultaPagos();
            }
            echo '
                <div style="display: flex; align-items: start; justify-content: space-between; margin-bottom: -1%">
                    <button class="btn btn-icon btn-outline-warning" style="background: yellow" onclick="invitadosInformacion()"><i class="fa-solid fa-question fa-flip"></i></button>
                </div>
                <h4 class="text-center"><span class="badge bg-success"><i class="fa-solid fa-dollar-sign"></i> Seleccciona el Cobro a realizar</span></h4>
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
        $hide = '';
        foreach ($lista as $row => $item) {
            if ($item[3] === $gradoAl || $item[3] === 'Todos') {
                $hide = '';
            } else {
                $hide = 'display: none;';
            }
            $acciones = '
                <td style="justify-content:center; display: flex;">
                    <a class="btn btn-info" href="index.php?seccion=realizarCobro&idpa='.$item[0].'&idal='.$id.'&con='.$item[1].'&mon='.$item[2].'">Seleccionar</a>
                </td>';
            $contenido = '
                    <td>' . $item[1] . '</td>
                    <td><span class="badge bg-success"><i class="fa-solid fa-dollar-sign"></i> '.$item[2].'</span></td>
                    <td>' . $item[3] . '</td>
                    ' . $acciones . '
            ';
            echo '
                <tr style="'.$hide.'">
                    '. $contenido .'
                </tr>
            ';
        }
    }
?>
        </tbody>
    </table>
</div>