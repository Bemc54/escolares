<?php
    //modelos
    include 'modelo/ModeloPagos.php';
    include 'modelo/ModeloAlumnos.php';
    include 'modelo/ModeloUsuarios.php';
    include 'modelo/ModeloIngresos.php';
    //controladores
    include 'controlador/ControladorPagos.php';
    include 'controlador/ControladorAlumnos.php';
    include 'controlador/ControladorUsuarios.php';
    include 'controlador/ControladorIngresos.php';
    include 'controlador/ControladorVistas.php';
    //plantilla
    include 'plantilla.php';

    // Verificar la existencia de la variable de tiempo de última actividad en la sesión
    if(isset($_SESSION['ultimo_acceso'])){
        $tiempo_transcurrido = time() - $_SESSION['ultimo_acceso'];
        
        // Cerrar la sesión si ha pasado más de 5 minutos (300 segundos) de inactividad
        $tiempo_max_inactividad = 3600;
        if($tiempo_transcurrido > $tiempo_max_inactividad){
            // Mostrar Sweet Alert
            echo '
                <script type="text/javascript">
                    let timerInterval;
                    Swal.fire({
                        title: "Se cerro la sesión por inactividad.",
                        html: "La Página se reiniciará en <b></b>.",
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            const timer = Swal.getPopup().querySelector("b");
                            timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                            window.location.href = "index.php"; // Redireccionamiento al index.php
                        }
                        }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log("I was closed by the timer");
                        }
                    });
                </script>
            ';

            // Destruir la sesión
            session_unset();
            session_destroy();
            exit; // Terminar el script después de redirigir
        }
    }
    // Actualizar el tiempo de última actividad en cada carga de página
    $_SESSION['ultimo_acceso'] = time();
?>