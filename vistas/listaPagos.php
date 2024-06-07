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
                $btnAgregar = '
                    <button id="add" style="bottom: 3rem; right: 3rem;" class="btn btn-success border border-success" onclick="crearPago()"><span class="fa fa-dollar-sign"></span></button>
                ';
            }
            echo '
                <div style="display: flex; align-items: start; justify-content: space-between; margin-bottom: -1%">
                    <button class="btn btn-icon btn-outline-warning" style="background: yellow" onclick="invitadosInformacion()"><i class="fa-solid fa-question fa-flip"></i></button>
                </div>
                '.$btnAgregar.'
                <h4 class="text-center"><span class="badge bg-success"><i class="fa-solid fa-dollar-sign"></i> Lista de Pagos</span></h4>
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
            $acciones = '
                <td style="justify-content:center; display: flex;">
                    <a class="btn btn-icon btn-info" href="index.php?seccion=editarPago&id=' . $item[0] . '"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-icon btn-danger" href="index.php?seccion=listaPagos&accion=eliminar&id=' . $item[0] . '"><i class="fa fa-trash"></i></a>
                </td>';
            $contenido = '
                    <td>' . $item[1] . '</td>
                    <td><span class="badge bg-success"><i class="fa-solid fa-dollar-sign"></i> '.$item[2].'</span></td>
                    <td>' . $item[3] . '</td>
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