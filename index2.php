<?php
include("conexionBD/class.database.php");

$connexion_class = new class_db();
$conexion = $connexion_class->conn;

if ($conexion->connect_error) die('Problemas con la conexion a la base de datos');

$conexion->close();

?>