<?php

include("../includes/conexion.php");

if (isset($_POST['crear_evento'])) {
    $tipo = mysqli_real_escape_string($enlace, $_POST['tipo']);
    $titulo = mysqli_real_escape_string($enlace, $_POST['titulo']);
    $fecha = mysqli_real_escape_string($enlace, $_POST['fecha']);
    $lugar = mysqli_real_escape_string($enlace, $_POST['lugar']);
    $hora = mysqli_real_escape_string($enlace, $_POST['hora']);
    $descripcion = mysqli_real_escape_string($enlace, $_POST['descripcion']);

    $sql = "INSERT INTO eventos (tipo, titulo, fecha, lugar, hora, descripcion)
            VALUES ('$tipo', '$titulo', '$fecha', '$lugar', '$hora', '$descripcion')";

    if (mysqli_query($enlace, $sql)) {
        echo "Evento creado exitosamente.";
    } else {
        echo "Error al crear evento: " . mysqli_error($enlace);
    }
}

?>

