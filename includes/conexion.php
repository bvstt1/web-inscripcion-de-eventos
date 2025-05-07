<?php
    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $baseDeDatos = "app-uda-inscripcion";

    $enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

    if (!$enlace) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
?>