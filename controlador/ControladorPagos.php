<?php
    class ControladorPagos {
        static function consultaPagos(){
            $tabla = 'pagos';
            $Pagos = ModeloPagos::selectPagos($tabla);
            $arreglo = $Pagos -> fetch_all();
            return $arreglo;
        }

        static function guardarPago(){
            if (isset($_POST["crear"])) {
                $tabla = 'pagos';
                $datos = array(
                    "concepto" => $_POST["concepto"],
                    "monto" => $_POST["monto"],
                    "tipo_alumno" => $_POST["tipo_alumno"],
                );
                $respuesta = ModeloPagos::insertarPago($tabla, $datos);
                if ($respuesta > 0) {
                    echo '
                        <script type="text/javascript">
                            Swal.fire({
                                icon: "success",
                                title: "Pago Creado",
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

        static function editarPago(){
            if(isset($_POST["editar"])){
                $tabla = 'pagos';
                $id = $_POST["id"];
                
                // Define el array de datos a actualizar
                $datos = array(
                    "concepto" => $_POST["concepto"],
                    "monto" => $_POST["monto"],
                    "tipo_alumno" => $_POST["tipo_alumno"],
                );
                // Llama al método para editar el empleado
                $respuesta = ModeloPagos::editPago($tabla, $datos, $id);
                if($respuesta > 0){
                    echo '
                        <script type="text/javascript">
                            Swal.fire({
                                icon: "success",
                                title: "Pago Editado",
                                showConfirmButton: true,
                            }).then(function() {
                                window.location.href = "index.php?seccion=listaPagos";
                            });
                        </script>
                    ';
                }
                else{
                    echo '
                        <script type="text/javascript">
                            Swal.fire({
                                icon: "error",
                                title: "Error al Editar",
                                showConfirmButton: true,
                            }).then(function() {
                                window.location.href = "index.php?seccion=listaPagos";
                            });
                        </script>
                    ';
                }
            }
        }

        static function eliminarPago(){
            if(isset($_GET["accion"]) && $_GET["accion"] == "eliminar" && isset($_GET["id"])){
                $tabla = 'pagos';
                $id = $_GET["id"];

                // Eliminar el registro de la base de datos
                $respuesta = ModeloPagos::deletePago($tabla, $id);

                if($respuesta > 0)
                {
                    echo '
                    <script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "Pago Borrado correctamente",
                            showConfirmButton: true,
                        }).then(function() {
                            
                        });
                    </script>
                    ';
                }
            }
        }

        static function consultaPagoID(){
            if(isset($_GET["id"])){
                $tabla = 'pagos';
                $id = $_GET["id"];
                $respuesta = ModeloPagos::selectPagoId($tabla, $id);
                $Pagos = $respuesta->fetch_all();
                return $Pagos;
            }
        }
    }
?>