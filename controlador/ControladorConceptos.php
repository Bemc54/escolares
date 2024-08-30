<?php
    class ControladorConceptos {
        static function consultaConceptos(){
            $tabla = 'concepto';
            $Conceptos = ModeloConceptos::selectConceptos($tabla);
            $arreglo = $Conceptos -> fetch_all();
            return $arreglo;
        }

        static function guardarConcepto(){
            if (isset($_POST["crearConcepto"])) {
                $tabla = 'concepto';
                $datos = array(
                    "concepto_pago" => $_POST["concepto_pago"],
                );
                $respuesta = ModeloConceptos::insertarConcepto($tabla, $datos);
                if ($respuesta > 0) {
                    echo '
                        <script type="text/javascript">
                            Swal.fire({
                                icon: "success",
                                title: "Concepto Creado",
                                showConfirmButton: true,
                            }).then(function() {
                                window.location.href = "index.php?seccion=listaPagos";
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

        static function eliminarConcepto(){
            if(isset($_GET["accion"]) && $_GET["accion"] == "Bconcepto" && isset($_GET["id"])){
                $tabla = 'concepto';
                $id = $_GET["id"];

                // Eliminar el registro de la base de datos
                $respuesta = ModeloConceptos::deleteConcepto($tabla, $id);

                if($respuesta > 0)
                {
                    echo '
                    <script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "Concepto Borrado correctamente",
                            showConfirmButton: true,
                        }).then(function() {
                            window.location.href = "index.php?seccion=listaPagos";
                        });
                    </script>
                    ';
                }
            }
        }
    }
?>