<?php
    class ControladorIngresos {
        static function consultaIngresos(){
            $tabla = 'ingresos';
            $Ingresos = ModeloIngresos::selectIngresos($tabla);
            $arreglo = $Ingresos -> fetch_all();
            return $arreglo;
        }

        static function guardarIngreso(){
            if (isset($_POST["cobrar"])) {
                $tabla = 'ingresos';
                $datos = array(
                    "id_al" => $_POST["id_al"],
                    "id_pa" => $_POST["id_pa"],
                    "concep" => $_POST["concep"],
                    "monto_pagado" => $_POST["monto_pagado"],
                    "fecha_pago" => $_POST["fecha_pago"],
                    "cobrador" => $_POST["cobrador"],
                    "metodo" => $_POST["metodo"],
                    "comentario" => $_POST["comentario"],
                );
                $respuesta = ModeloIngresos::insertarIngreso($tabla, $datos);
                if ($respuesta > 0) {
                    echo '
                        <script type="text/javascript">
                            Swal.fire({
                                icon: "success",
                                title: "Ingreso Creado",
                                showConfirmButton: true,
                                }).then(function() {
                                window.location.href = "index.php?seccion=listaIngresos";
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

        static function consultaTodoIngresoID($id){
            $tabla = 'ingresos';
            $Ingresos = ModeloIngresos::selectAllIngresosID($tabla, $id);
            $arreglo = $Ingresos -> fetch_all();
            return $arreglo;
        }

        static function editarIngreso(){
            if(isset($_POST["editar"])){
                $tabla = 'ingresos';
                $id = $_POST["id"];
                
                // Define el array de datos a actualizar
                $datos = array(
                    "id_al" => $_POST["id_al"],
                    "id_pa" => $_POST["id_pa"],
                    "concep" => $_POST["concep"],
                    "monto_pagado" => $_POST["monto_pagado"],
                    "fecha_pago" => $_POST["fecha_pago"],
                    "cobrador" => $_POST["cobrador"]
                );
                // Llama al método para editar el empleado
                $respuesta = ModeloIngresos::editIngreso($tabla, $datos, $id);
                if($respuesta > 0){
                    echo '
                        <script type="text/javascript">
                            Swal.fire({
                                icon: "success",
                                title: "Ingreso Editado",
                                showConfirmButton: true,
                            }).then(function() {
                                window.location.href = "index.php?seccion=listaIngresos";
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
                                window.location.href = "index.php?seccion=listaIngresos";
                            });
                        </script>
                    ';
                }
            }
        }

        static function consultaIngresoID(){
            if(isset($_GET["id"])){
                $tabla = 'ingresos';
                $id = $_GET["id"];
                $respuesta = ModeloIngresos::selectIngresoId($tabla, $id);
                $Ingresos = $respuesta->fetch_all();
                return $Ingresos;
            }
        }

        static function consultaIngresoPorAlumno(){
            if(isset($_GET["id"])){
                $tabla = 'ingresos';
                $id = $_GET["id"];
                $respuesta = ModeloIngresos::selectIngresoPorAlumno($tabla, $id);
                $Ingresos = $respuesta->fetch_all();
                return $Ingresos;
            }
        }

        static function eliminarIngreso(){
            if(isset($_GET["accion"]) && $_GET["accion"] == "eliminar" && isset($_GET["id"])){
                $tabla = 'ingresos';
                $id = $_GET["id"];

                // Eliminar el registro de la base de datos
                $respuesta = ModeloIngresos::deleteIngreso($tabla, $id);

                if($respuesta > 0)
                {
                    echo '
                    <script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "Ingreso Borrado correctamente",
                            showConfirmButton: true,
                        }).then(function() {
                            
                        });
                    </script>
                    ';
                }
            }
        }
    }
?>