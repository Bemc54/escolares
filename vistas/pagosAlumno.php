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
        $id = $_GET['id'];
        $alumno = ControladorAlumnos::consultaAlumnoID($id);
        $nombreAl = $alumno[0][1];
        $grado = $alumno[0][4];
        $eliminar = new ControladorIngresos;
        $eliminar -> eliminarIngreso();
        $heads = '
            <th>Folio</th>
            <th>Concepto</th>
            <th>Monto</th>
            <th>Fecha de Pago</th>
            <th>Comentario</th>
            <th>Cobrador</th>
            <th>Metodo de Pago</th>
            <th>Fun</th>
        ';
        $btnAgregar = '';
        if (isset($_SESSION['rol'])) {
            $lista = ControladorIngresos::consultaIngresoPorAlumno($id);
            $btnAgregar = '
                <a id="add" style="bottom: 3rem; right: 3rem; width: 15rem; display: flex; align-items:center; justify-content: center" class="btn btn-success border border-success" href="index.php?seccion=cobrarAlumno&idal='.$id.'&grade='.$grado.'&carr='.$alumno[0][5].'"><i class="fa fa-cash-register"></i> Realizar Cobro</a>
            ';
            if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'sx' || $_SESSION['rol'] == 'Conta' ) {
                $deleteAl = '
                    <a id="deleteAl" style="top: 5.5rem; left: 30rem; width: 10rem; height: 3rem; display: flex; align-items:center; justify-content: center" class="btn btn-outline-danger border border-danger btn-floating" href="index.php?seccion=listaAlumnos&accion=eliminar&id=' . $alumno[0][0] . '"><span class="fa fa-trash"></span> Borrar Alumno</a>
                    <a id="deleteAl" style="top: 5.5rem; right: 30rem; width: 10rem; height: 3rem; display: flex; align-items:center; justify-content: center" class="btn btn-outline-primary border border-primary btn-floating" href="index.php?seccion=editarAlumno&id=' . $alumno[0][0] . '"><span class="fa fa-edit"></span> Editar Alumno</a>
                ';   
            } else {
                $deleteAl = '';
            }
            echo '
                <div style="display: flex; align-items: start; justify-content: space-between; margin-bottom: -1%">
                    <button class="btn btn-icon btn-outline-warning" style="background: yellow" onclick="infoPagosAl()"><i class="fa-solid fa-question fa-flip"></i></button>
                </div>
                '.$btnAgregar.'
                '.$deleteAl.'
                <h4 class="text-center"><span class="badge bg-success"><i class="fa-solid fa-user-graduate"></i> Lista de Pagos de '.$nombreAl.'</span></h4>
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
                        window.location.href = "index.php?seccion=listaAlumnos";
                    });
                </script>
            ';
        }
        $acciones = '';
        foreach ($lista as $row => $item) {
            if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'sx') {
                $acciones = '
                    <a class="btn btn-icon btn-success" href="index.php?seccion=generarTicket&idpa=' . $item[0] . '"><i class="fa fa-receipt"></i></a>
                    <a class="btn btn-icon btn-danger" href="index.php?seccion=pagosAlumno&id='.$id.'&accion=suprimir&idpa=' . $item[0] . '"><i class="fa fa-trash"></i></a>
                ';
            } else {
                $acciones = '
                    <a class="btn btn-icon btn-success" href="index.php?seccion=generarTicket&id=' . $item[0] . '"><i class="fa fa-receipt"></i></a>
                ';
            }
            $contenido = '
                    <td>' . $item[0] . '</td>
                    <td>' . $item[3] . '</td>
                    <td><span class="badge bg-success"><i class="fa-solid fa-dollar-sign"></i> '.$item[4].'</span></td>
                    <td>' . $item[5] . '</td>
                    <td>' . $item[8] . '</td>
                    <td>' . $item[6] . '</td>
                    <td>' . $item[7] . '</td>
                    <td style="justify-content:space-around; display: flex;">' . $acciones . '</td>
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