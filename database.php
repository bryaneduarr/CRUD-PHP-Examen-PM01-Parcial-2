<?php

class DataBase
{
  private $host = "localhost";
  private $database = "ExamenPm01Grupo1";
  private $username = "root";
  private $password = "";

  public $conexion;

  // Funcion de conexion a la base de datos.

  public function getConnection()
  {
    $this->conexion = null;

    try {

      $this->conexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);

      $this->conexion->exec("set names utf8");

    } catch (PDOException $exception) {

      echo "No se pudo conectar al a base datos: " . $exception->getMessage();
    }

    return $this->conexion;
  }
}
