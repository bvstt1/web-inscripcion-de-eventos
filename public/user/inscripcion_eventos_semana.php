<?php
include("../../includes/conexion.php");
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

// Obtener datos del evento semanal
$queryEvento = "SELECT * FROM eventos WHERE id = $id_evento AND tipo = 'semanal'";
$resultEvento = mysqli_query($enlace, $queryEvento);
$evento = mysqli_fetch_assoc($resultEvento);

if (!$evento) {
    echo "<script>alert('Evento semanal no encontrado.'); window.history.back();</script>";
    exit();
}

// Traer inscripciones del usuario
$sql_inscripciones = "SELECT id_evento FROM inscripciones WHERE rut_usuario = '$rut'";
$resultado_inscripciones = mysqli_query($enlace, $sql_inscripciones);

$eventos_inscritos = [];
while ($row = mysqli_fetch_assoc($resultado_inscripciones)) {
    $eventos_inscritos[] = $row['id_evento'];
}

// Obtener subeventos (eventos diarios)
$querySubeventos = "SELECT * FROM eventos WHERE id_evento_padre = $id_evento ORDER BY fecha";
$resultSubeventos = mysqli_query($enlace, $querySubeventos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar día</title>
    <link rel="stylesheet" href="../css/video.css">
</head>
<body style="font-family: Arial; padding: 20px;">
    <h1>📅 Eventos de la semana: <?php echo htmlspecialchars($evento['titulo']); ?></h1>
    <p>Selecciona uno de los eventos diarios disponibles:</p>
    <?php if (mysqli_num_rows($resultSubeventos) > 0): ?>
        <ul>
            <?php while ($sub = mysqli_fetch_assoc($resultSubeventos)): ?>
                <li style="margin-bottom: 15px;">
                    <strong><?php echo htmlspecialchars($sub['fecha']); ?>:</strong><br>
                    <span style="font-weight: bold;"><?php echo htmlspecialchars($sub['titulo']); ?></span><br>
                    <div style="margin-left: 10px; margin-top: 5px;">
                        <?php echo $sub['descripcion']; // mostrar con HTML permitido ?>
                    </div>
                    <div style="margin-top: 5px;">
                        <?php if (in_array($sub['id'], $eventos_inscritos)): ?>
                            <a href="../../php/desincribir.php?id_evento=<?php echo $sub['id']; ?>" onclick="return confirm('¿Deseas desinscribirte de este evento?');">Desinscribirse</a>
                        <?php else: ?>
                            <a href="../../php/inscribir.php?id_evento=<?php echo $sub['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas inscribirte a este evento?');">Inscribirse</a>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>Este evento semanal aún no tiene días creados.</p>
    <?php endif; ?>
    <a href="./inscripcion_a_eventos.php">⬅ Volver</a>

    <script src="../../js/youtube.js"></script>
</body>
</html>
