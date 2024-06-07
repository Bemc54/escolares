<?php
    include_once 'conexion.php';
    class ModeloPagos{
        static function selectPagos($tabla){
            $sql = "select * from $tabla;";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
            $rs -> close();
        }

        static function insertarPago($tabla, $datos){
            $sql = "insert into $tabla(
                id,
                concepto,
                monto,
                tipo_alumno
                ) values
                (null,
                '$datos[concepto]',
                '$datos[monto]',
                '$datos[tipo_alumno]'
            );";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }

        static function editPago($tabla, $datos, $id){
            $sql = "update $tabla set
                concepto = '$datos[concepto]',
                monto = '$datos[monto]',
                tipo_alumno = '$datos[tipo_alumno]'
                WHERE id = '$id';"
            ;
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }

        static function selectPagoId($tabla, $id){
            $sql = "select * from $tabla where id = '$id';";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
            $rs->close();
        }

        static function deletePago($tabla, $id){
            $sql = "delete from $tabla where id ='$id';";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }
    }
?>