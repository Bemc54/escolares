<?php
    include_once 'conexion.php';
    class ModeloConceptos{
        static function selectConceptos($tabla){
            $sql = "select * from $tabla;";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
            $rs -> close();
        }

        static function insertarConcepto($tabla, $datos){
            $sql = "insert into $tabla(
                id,
                concepto_pago
                ) values
                (null,
                '$datos[concepto_pago]'
            );";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }

        static function deleteConcepto($tabla, $id){
            $sql = "delete from $tabla where id ='$id';";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }
    }
?>