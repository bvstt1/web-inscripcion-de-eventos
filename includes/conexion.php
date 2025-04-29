<?php
    $servidor = "localhost";
    $usuario = "root";
    $clave = "yerkirils1";
    $baseDeDatos = "app-uda-inscripcion";

    $enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

    if (!$enlace) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
?>