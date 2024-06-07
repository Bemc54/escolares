<?php
    include_once 'conexion.php';
    class ModeloIngresos{
        static function selectIngresos($tabla){
            $sql = "
                SELECT 
                    ingresos.id AS ingreso_id, 
                    ingresos.id_al, 
                    ingresos.id_pa, 
                    ingresos.concep, 
                    ingresos.monto_pagado, 
                    ingresos.fecha_pago, 
                    ingresos.cobrador, 
                    ingresos.metodo, 
                    ingresos.comentario,
                    alumnos.nombre AS alumno_nombre,
                    alumnos.telefono AS alumno_telefono,
                    alumnos.correo AS alumno_correo,
                    alumnos.grado_estudio AS alumno_grado_estudio,
                    alumnos.carrera AS alumno_carrera,
                    pagos.concepto AS pago_concepto,
                    pagos.monto AS pago_monto,
                    pagos.tipo_alumno AS pago_tipo_alumno
                FROM $tabla
                INNER JOIN alumnos ON ingresos.id_al = alumnos.id
                INNER JOIN pagos ON ingresos.id_pa = pagos.id;
            ";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
            $rs -> close();
        }

        static function selectAllIngresosID($tabla, $id){
            $sql = "
                select 
                    ing.*,
                    al.id as id_al,
                    al.nombre as nombre_al,
                    al.grado_estudio as grado_al,
                    pa.id as id_pa,
                    pa.concepto as concepto_pa
                from $tabla as ing
                inner join alumnos as al
                on ing.id_al = al.id
                inner join pagos as pa
                on ing.id_pa = pa.id
                where ing.id = '$id'
            ";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
            $rs -> close();
        }

        static function insertarIngreso($tabla, $datos){
            $sql = "insert into $tabla(
                id,
                id_al,
                id_pa,
                concep,
                monto_pagado,
                fecha_pago,
                cobrador,
                metodo,
                comentario
                ) values
                (null,
                '$datos[id_al]',
                '$datos[id_pa]',
                '$datos[concep]',
                '$datos[monto_pagado]',
                '$datos[fecha_pago]',
                '$datos[cobrador]',
                '$datos[metodo]',
                '$datos[comentario]'
            );";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }

        static function editIngreso($tabla, $datos, $id){
            $sql = "update $tabla set
                id_al = '$datos[id_al]',
                id_pa = '$datos[id_pa]',
                concep = '$datos[concep]',
                monto_pagado = '$datos[monto_pagado]',
                fecha_pago = '$datos[fecha_pago]',
                cobrador = '$datos[cobrador]'
                WHERE id = '$id';"
            ;
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }

        static function selectIngresoId($tabla, $id){
            $sql = "select * from $tabla where id = '$id';";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
            $rs->close();
        }

        static function selectIngresoPorAlumno($tabla, $id){
            $sql = "select * from $tabla where id_al = '$id';";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
            $rs->close();
        }

        static function deleteIngreso($tabla, $id){
            $sql = "delete from $tabla where id ='$id';";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }
    }
?>