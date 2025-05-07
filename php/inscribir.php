<?php
include("../includes/conexion.php");
session_start();

// Verificar sesión
if (!isset($_SESSION['rut']) || !isset($_SESSION['tipo_usuario'])) {
    echo "<script>alert('Error: No has iniciado sesión.'); window.location.href='../../index.html';</script>";
    exit();
}

// Verificar ID de evento
if (!isset($_GET['id_evento'])) {
    echo "<script>alert('Error: No se recibió el ID del evento.'); window.history.back();</script>";
    exit();
}

$rut = $_SESSION['rut'];
$tipo_usuario = $_SESSION['tipo_usuario'];
$id_evento = intval($_GET['id_evento']);

// Verificar si el evento existe
$queryEvento = "SELECT * FROM eventos WHERE id = $id_evento";
$resultEvento = mysqli_query($enlace, $queryEvento);
$evento = mysqli_fetch_assoc($resultEvento);

if (!$evento) {
    echo "<script>alert('Evento no encontrado.'); window.history.back();</script>";
    exit();
}

// Traer inscripciones del usuario
$sql_inscripciones = "SELECT id_evento FROM inscripciones WHERE rut_usuario = '$rut'";
$resultado_inscripciones = mysqli_query($enlace, $sql_inscripciones);

$eventos_inscritos = [];
while ($row = mysqli_fetch_assoc($resultado_inscripciones)) {
    $eventos_inscritos[] = $row['id_evento'];
}

// Si es evento diario → inscribimos directamente
$sql = "INSERT INTO inscripciones (rut_usuario, id_evento, tipo_usuario) 
        VALUES ('$rut', $id_evento, '$tipo_usuario')";

if (mysqli_query($enlace, $sql)) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Inscripción Exitosa</title>
    </head>
    <body style="text-align: center; padding-top: 100px; font-family: Arial, sans-serif;">
        <h1>🎉 ¡Inscripción exitosa! 🎉</h1>
        <p>Te has inscrito correctamente al evento.</p>
        <a href="../public/user/inscripcion_a_eventos.php" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Ver eventos disponibles</a>
    </body>
    </html>
    <?php
} else {
    echo "<script>alert('Error en la inscripción: " . mysqli_error($enlace) . "'); window.history.back();</script>";
}
