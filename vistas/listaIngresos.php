<div class="col-11 list">
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
        $eliminar = new ControladorIngresos;
        $eliminar -> eliminarIngreso();
        $heads = '
            <th>ID Pago</th>
            <th>Alumno</th>
            <th>Grado</th>
            <th>Concepto</th>
            <th>Monto</th>
            <th>Fecha de Pago</th>
            <th>Metodo de Pago</th>
            <th>Comentario</th>
            <th>Cobrador</th>
            <th>Ticket</th>
        ';
        $btnAgregar = '';
        if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'sx') {
            if ($_SESSION['rol'] == 'sx') {
                $lista = ControladorIngresos::consultaIngresos();
            }
            echo '
                <div style="display: flex; align-items: start; justify-content: space-between; margin-bottom: -1%">
                    <button class="btn btn-icon btn-outline-warning" style="background: yellow" onclick="invitadosInformacion()"><i class="fa-solid fa-question fa-flip"></i></button>
                </div>
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
            $contenido = '
                    <td>' . $item[0] . '</td>
                    <td>' . $item[9] . '</td>
                    <td>' . $item[12] . '</td>
                    <td>' . $item[3] . '</td>
                    <td><span class="badge bg-success"><i class="fa-solid fa-dollar-sign"></i> '.$item[4].'</span></td>
                    <td>' . $item[5] . '</td>
                    <td>' . $item[7] . '</td>
                    <td>' . $item[8] . '</td>
                    <td>' . $item[6] . '</td>
                    <td style="justify-content:center; display: flex;">
                        <a class="btn btn-icon btn-success" href="index.php?seccion=generarTicket&id=' . $item[0] . '"><i class="fa fa-receipt"></i></a>
                    </td>
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