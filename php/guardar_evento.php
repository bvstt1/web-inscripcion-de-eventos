<?php

include("../includes/conexion.php");

if (isset($_POST['crear_evento'])) {
    $tipo = mysqli_real_escape_string($enlace, $_POST['tipo']);
    $titulo = mysqli_real_escape_string($enlace, $_POST['titulo']);
    $fecha = mysqli_real_escape_string($enlace, $_POST['fecha']);
    $lugar = mysqli_real_escape_string($enlace, $_POST['lugar']);
    $descripcion = mysqli_real_escape_string($enlace, $_POST['descripcion']);

    $hora = isset($_POST['hora']) && $_POST['hora'] !== '' 
    ? "'" . mysqli_real_escape_string($enlace, $_POST['hora']) . "'"
    : 'NULL';

    $id_evento_padre = isset($_POST['evento_padre']) && $_POST['evento_padre'] !== ''
        ? intval($_POST['evento_padre'])
        : 'NULL';

    $sql = "INSERT INTO eventos (tipo, titulo, fecha, lugar, hora, descripcion, id_evento_padre)
        VALUES ('$tipo', '$titulo', '$fecha', '$lugar', $hora, '$descripcion', $id_evento_padre)";


    if (mysqli_query($enlace, $sql)) {
        echo "Evento creado exitosamente.";
    } else {
        echo "Error al crear evento: " . mysqli_error($enlace);
    }
}
?>
