<?php
    class ControladorCarreras {
        static function consultaCarreras(){
            $tabla = 'carrera';
            $Carreras = ModeloCarreras::selectCarreras($tabla);
            $arreglo = $Carreras -> fetch_all();
            return $arreglo;
        }

        static function guardarCarrera(){
            if (isset($_POST["carrera"])) {
                $tabla = 'carrera';
                $datos = array(
                    "carreras" => $_POST["carreras"],
                );
                $respuesta = ModeloCarreras::insertarCarrera($tabla, $datos);
                if ($respuesta > 0) {
                    echo '
                        <script type="text/javascript">
                            Swal.fire({
                                icon: "success",
                                title: "Carrera Creado",
                                showConfirmButton: true,
                            }).then(function() {
                                window.location.href = "index.php?seccion=listaAlumnos";
                            });
                        </script>
                    ';
                } else {
                    echo '
                        <script type="text/javascript">
                            Swal.fire({
                                icon: "error",
                                title: "Error al Guardar",
                                showConfirmButton: true,
                            })
                        </script>
                    ';
                }
            }
        }

        static function eliminarCarrera(){
            if(isset($_GET["accion"]) && $_GET["accion"] == "Bcarrera" && isset($_GET["id"])){
                $tabla = 'carrera';
                $id = $_GET["id"];

                // Eliminar el registro de la base de datos
                $respuesta = ModeloCarreras::deleteCarrera($tabla, $id);

                if($respuesta > 0)
                {
                    echo '
                    <script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "Carrera Borrado correctamente",
                            showConfirmButton: true,
                        }).then(function() {
                            window.location.href = "index.php?seccion=listaAlumnos";
                        });
                    </script>
                    ';
                }
            }
        }
    }
?>