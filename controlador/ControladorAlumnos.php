<?php
    class ControladorAlumnos {
        static function consultaAlumnos(){
            $tabla = 'alumnos';
            $alumnos = ModeloAlumnos::selectAlumnos($tabla);
            $arreglo = $alumnos -> fetch_all();
            return $arreglo;
        }

        static function consultaAlumnosAdeudos($inicio, $fin){
            $tabla = 'alumnos';
            $alumnos = ModeloAlumnos::selectAlumnosAdeudos($tabla, $inicio, $fin);
            $arreglo = $alumnos -> fetch_all();
            return $arreglo;
        }

        static function registroAlumno(){
            if (isset($_POST["guardar"])) {
                $tabla = 'alumnos';
                $datos = array(
                    "nombre" => $_POST["nombre"],
                    "telefono" => $_POST["telefono"],
                    "correo" => $_POST["correo"],
                    "grado_estudio" => $_POST["grado_estudio"],
                    "carrera" => $_POST["carrera"],
                    "status" => $_POST["status"]
                );
                $respuesta = ModeloAlumnos::insertarAlumno($tabla, $datos);
                if ($respuesta > 0) {
                    echo '
                        <script type="text/javascript">
                            Swal.fire({
                                icon: "success",
                                title: "Alumno Creado",
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

        static function editarAlumno(){
            if(isset($_POST["editar"])){
                $tabla = 'alumnos';
                $id = $_POST["id"];
                
                // Define el array de datos a actualizar
                $datos = array(
                    "nombre" => $_POST["nombre"],
                    "telefono" => $_POST["telefono"],
                    "correo" => $_POST["correo"],
                    "grado_estudio" => $_POST["grado_estudio"],
                    "carrera" => $_POST["carrera"],
                    "status" => $_POST["status"]
                );
                // Llama al método para editar el empleado
                $respuesta = ModeloAlumnos::editAlumno($tabla, $datos, $id);
                if($respuesta > 0){
                    echo '
                        <script type="text/javascript">
                            Swal.fire({
                                icon: "success",
                                title: "Alumno Editado",
                                showConfirmButton: true,
                            }).then(function() {
                                window.location.href = "index.php?seccion=listaAlumnos";
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
                                window.location.href = "index.php?seccion=listaAlumnos";
                            });
                        </script>
                    ';
                }
            }
        }

        static function consultaAlumnoID(){
            if(isset($_GET["id"])){
                $tabla = 'alumnos';
                $id = $_GET["id"];
                $respuesta = ModeloAlumnos::selectAlumnoId($tabla, $id);
                $alumnos = $respuesta->fetch_all();
                return $alumnos;
            }
        }

        static function eliminarAlumno(){
            if(isset($_GET["accion"]) && $_GET["accion"] == "eliminar" && isset($_GET["id"])){
                $tabla = 'alumnos';
                $id = $_GET["id"];

                // Eliminar el registro de la base de datos
                $respuesta = ModeloAlumnos::deleteAlumno($tabla, $id);

                if($respuesta > 0)
                {
                    echo '
                    <script type="text/javascript">
                        Swal.fire({
                            icon: "success",
                            title: "Alumno Borrado correctamente",
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