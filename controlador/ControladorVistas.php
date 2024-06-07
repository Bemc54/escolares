<?php
    class ControladorVistas{
        function cargarVista(){
            if(isset($_GET["seccion"])){
                //aqui cargamos la seccion deseada
                $ruta = "vistas/".$_GET["seccion"].".php";
                include $ruta;
            }else{
                //aqui cargamos la seccion default
                include "vistas/inicio.php";
            }
        }
    }
?>