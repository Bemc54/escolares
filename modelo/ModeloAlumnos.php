<?php
    include_once 'conexion.php';
    class ModeloAlumnos{
        static function selectAlumnos($tabla){
            $sql = "select * from $tabla;";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
            $rs -> close();
        }

        static function insertarAlumno($tabla, $datos){
            $sql = "insert into $tabla(
                id,
                nombre,
                telefono,
                correo,
                grado_estudio
                ) values
                (null,
                '$datos[nombre]',
                '$datos[telefono]',
                '$datos[correo]',
                '$datos[grado_estudio]'
            );";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }

        static function editAlumno($tabla, $datos, $id){
            $sql = "update $tabla set
                nombre = '$datos[nombre]',
                telefono = '$datos[telefono]',
                correo = '$datos[correo]',
                grado_estudio = '$datos[grado_estudio]'
                WHERE id = '$id';"
            ;
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }

        static function selectAlumnoId($tabla, $id){
            $sql = "select * from $tabla where id = '$id';";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
            $rs->close();
        }

        static function deleteAlumno($tabla, $id){
            $sql = "delete from $tabla where id ='$id';";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }
    }
?>