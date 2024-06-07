<?php
    require 'vendor/autoload.php';  // Asegúrate de que la ruta sea correcta
    class ControladorUsuarios{
        static function consultaUsuarios(){
            $tabla = 'usuarios';
            $usuario = ModeloUsuarios::selectUsuarios($tabla);
            $arreglo = $usuario -> fetch_all();
            return $arreglo;
        }

        static function guardarUsuario(){
            if(isset($_POST["guardar"])){
                $tabla = 'usuarios';
                $datos = array(
                    "nombre" => $_POST["nombre"],
                    "nombre_usu" => $_POST["nombre_usu"],
                    "mail" => $_POST["mail"],
                    "contraseña" => $_POST["contraseña"],
                    "tipo" => $_POST["tipo"]
                );
        
                $respuesta = ModeloUsuarios::insertarUsuarios($tabla, $datos);
        
                if($respuesta > 0){
                    echo '
                        <script type="text/javascript">
                            Swal.fire({
                                icon: "error",
                                title: "Usuario Creado con Exito",
                                text: "Ya puede Iniciar Sesión con este Usuario",
                                showConfirmButton: true,
                            }).then(function() {
                                window.location.href = "index.php?seccion=listaAlumnos";
                            });
                        </script>
                    ';
                } else {
                    // Mostrar mensaje de error si falla el registro de usuario
                    echo '
                        <script type="text/javascript">
                            Swal.fire({
                                icon: "error",
                                title: "Error al Guardar",
                                showConfirmButton: true,
                            }).then(function() {
                                window.location.href = "index.php?seccion=listaAlumnos";
                            });
                        </script>
                    ';
                }
            }
        }        

        static function borrarUsuario(){
            if(isset($_GET["accion"]) && $_GET["accion"] == "eliminar"){
                $tabla = 'usuarios';
                $id = $_GET["id"];
                $respuestausuario = ModeloUsuarios::deleteUsuario($tabla, $id);
        
                if($respuestausuario > 0){
                    echo '
                        <script type="text/javascript">
                            Swal.fire({
                                icon: "error",
                                title: "Borrado Correctamente",
                                showConfirmButton: true,
                            }).then(function() {
                                
                            });
                        </script>
                    ';
                }
            }
        }        

        static function validarLogin(){
            if(isset($_POST["entrar"])){
                $mail = $_POST["mail"];
                $password = $_POST["password"];
                $usuario = ModeloUsuarios::login($mail, $password);

                $count = $usuario->num_rows;
                if($count>0){
                    header('Location: index.php?seccion=listaAlumnos');
                    $array = $usuario->fetch_all();
                    foreach($array as $row => $item){
                        session_start();
                        $_SESSION['nombre'] = $item[1];
                        $_SESSION['rol'] = $item[5];
                        $_SESSION['ultimo_acceso'] = time(); // Actualizar el tiempo de última actividad
                    }
                }
                else{
                    echo '
                        <script type="text/javascript">
                            Swal.fire({
                                icon: "error",
                                title: "Datos Incorrectos",
                                text: "Intente nuevamente",
                                showConfirmButton: true,
                            })
                        </script>
                    ';
                }
            }
        }
    }
?>