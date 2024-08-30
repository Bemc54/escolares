<?php
    include_once 'conexion.php';
    class ModeloCarreras{
        static function selectCarreras($tabla){
            $sql = "select * from $tabla;";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
            $rs -> close();
        }

        static function insertarCarrera($tabla, $datos){
            $sql = "insert into $tabla(
                id,
                carreras
                ) values
                (null,
                '$datos[carreras]'
            );";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }

        static function deleteCarrera($tabla, $id){
            $sql = "delete from $tabla where id ='$id';";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }
    }
?>