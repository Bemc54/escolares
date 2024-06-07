<?php
  class Conexion{
    public static function conectar(){
      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "project_sx";

      $con = new mysqli($servername, $username, $password, $database);
      if ($con->connect_error) 
      {
        echo "error";
      }
      else
      {
        // Establecer la codificación de caracteres a UTF-8
        $con->set_charset("utf8mb4");
        return $con;
      }
    }
  }
?>