<?php
    include_once 'conexion.php';
    class ModeloAlumnos{
        static function selectAlumnos($tabla){
            $sql = "select * from $tabla;";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
            $rs -> close();
        }

        static function selectAlumnosAdeudos($tabla, $inicio, $fin){
            $sql = "
                SELECT
                    alumnos.id,
                    alumnos.nombre,
                    alumnos.telefono,
                    alumnos.correo,
                    alumnos.grado_estudio,
                    alumnos.carrera,
                    alumnos.status,
                    GROUP_CONCAT(pagos.concepto) as ingresos_adeudados
                FROM $tabla
                JOIN pagos ON alumnos.grado_estudio = pagos.tipo_alumno
                LEFT JOIN ingresos ON alumnos.id = ingresos.id_al
                    AND pagos.id = ingresos.id_pa
                    AND STR_TO_DATE(ingresos.fecha_pago, '%d/%m/%Y') BETWEEN STR_TO_DATE('$inicio', '%d/%m/%Y') AND STR_TO_DATE('$fin', '%d/%m/%Y')
                WHERE ingresos.id IS NULL
                GROUP BY alumnos.id;
            ";
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
                grado_estudio,
                carrera,
                status
                ) values
                (null,
                '$datos[nombre]',
                '$datos[telefono]',
                '$datos[correo]',
                '$datos[grado_estudio]',
                '$datos[carrera]',
                '$datos[status]'
            );";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }

        static function editAlumno($tabla, $datos, $id){
            $sql = "update $tabla set
                nombre = '$datos[nombre]',
                telefono = '$datos[telefono]',
                correo = '$datos[correo]',
                grado_estudio = '$datos[grado_estudio]',
                carrera = '$datos[carrera]',
                status = '$datos[status]'
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