<?php
include("../includes/conexion.php");
session_start();

if (!isset($_SESSION['rut']) || !isset($_GET['id_evento'])) {
    echo "<script>alert('Error: Sesión no iniciada o evento no recibido.'); window.history.back();</script>";
    exit();
}

$rut = $_SESSION['rut'];
$id_evento = intval($_GET['id_evento']);

// Eliminar inscripción
$sql = "DELETE FROM inscripciones WHERE rut_usuario = '$rut' AND id_evento = $id_evento";

if (mysqli_query($enlace, $sql)) {
    if (mysqli_affected_rows($enlace) > 0) {
        // Éxito: mostramos página de confirmación
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Desinscripción Exitosa</title>
        </head>
        <body style="text-align: center; padding-top: 100px; font-family: Arial, sans-serif;">
            <h1>❌ Te has desinscrito correctamente ❌</h1>
            <p>Ya no estás inscrito en este evento.</p>
            <a href="../public/user/inscripcion_a_eventos.php" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">Ver eventos disponibles</a>
        </body>
        </html>
        <?php
    } else {
        echo "<script>alert('No se encontró inscripción para eliminar.'); window.location.href='../public/user/inscripcion_a_eventos.php';</script>";
    }
} else {
    echo "<script>alert('Error en el DELETE: " . mysqli_error($enlace) . "'); window.history.back();</script>";
}
?>
