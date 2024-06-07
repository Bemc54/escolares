<?php
    include_once 'conexion.php';
    class ModeloUsuarios{
        static function selectUsuarios($tabla){
            $sql = "select * from $tabla;";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
            $rs -> close();
        }

        static function insertarUsuarios($tabla,$datos){
            $sql = "insert into $tabla(
                id,
                nom_usu,
                tel,
                mail,
                pass,
                rol
                ) values 
                (null, 
                '$datos[nom_usu]',
                '$datos[tel]',
                '$datos[mail]',
                '$datos[pass]',
                '$datos[rol]'
            );";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }

        static function deleteUsuario($tabla, $id)
        {
            $sql = "delete from $tabla where id='$id';";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
        }

        static function login($mail, $password){
            $sql = "select * from usuarios where (mail = '$mail' or nom_usu = '$mail') and pass = '$password';";
            $rs = Conexion::conectar()->query($sql);
            return $rs;
            $rs -> close();
        }
    }
?>