<?php
$host = 'localhost';
$dbname = 'bdvictorquintana';
$username = 'root';
$password = 'User.sede';

$conexion = new mysqli($host, $username, $password, $dbname);

if ($conexion->connect_errno) {
    die("❌ Error al conectar a la Base de Datos: " . $conexion->connect_error);
}
?>