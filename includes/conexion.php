<?php
$conexion = new mysqli("localhost", "root", "", "app-uda-inscripcion");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
