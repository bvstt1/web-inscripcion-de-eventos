<?php
include("../../includes/conexion.php");
session_start();

// Verificar sesión
if (!isset($_SESSION['rut']) || !isset($_SESSION['tipo_usuario'])) {
    echo "<script>alert('Error: No has iniciado sesión.'); window.location.href='../../index.html';</script>";
    exit();
}

// Traer eventos semanales y diarios que no esten asociados a ningún evento semanal
$sql = "SELECT * FROM eventos WHERE id_evento_padre IS NULL";
$resultado = mysqli_query($enlace, $sql);

// Separar eventos diarios y semanales
$eventos_diarios = [];
$eventos_semanales = [];

while ($evento = mysqli_fetch_assoc($resultado)) {
    if ($evento['tipo'] == 'diario') {
        $eventos_diarios[] = $evento;
    } elseif ($evento['tipo'] == 'semanal') {
        $eventos_semanales[] = $evento;
    }
}

// Traer inscripciones del usuario
$rut_usuario = $_SESSION['rut'];
$sql_inscripciones = "SELECT id_evento FROM inscripciones WHERE rut_usuario = '$rut_usuario'";
$resultado_inscripciones = mysqli_query($enlace, $sql_inscripciones);

$eventos_inscritos = [];
while ($row = mysqli_fetch_assoc($resultado_inscripciones)) {
    $eventos_inscritos[] = $row['id_evento'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eventos Disponibles</title>
    <link rel="stylesheet" href="../css/video.css">
</head>
<body>

    <!-- Botón de cerrar sesión -->
    <a href="../../php/logout.php">Cerrar Sesión</a>

    <h1>Eventos Disponibles</h1>

    <!-- Sección Eventos Diarios -->
    <h2>Eventos Diarios</h2>
    <?php if (empty($eventos_diarios)): ?>
        <p>No hay eventos diarios disponibles.</p>
    <?php else: ?>
        <?php foreach ($eventos_diarios as $evento): ?>
            <div>
                <h3><?php echo htmlspecialchars($evento['titulo']); ?></h3>
                <p><strong>Fecha:</strong> <?php echo htmlspecialchars($evento['fecha']); ?></p>
                <p><strong>Hora:</strong> <?php echo htmlspecialchars($evento['hora']); ?></p>
                <p><strong>Lugar:</strong> <?php echo htmlspecialchars($evento['lugar']); ?></p>
                <p><?php echo $evento['descripcion']; ?></p>
                <?php if (in_array($evento['id'], $eventos_inscritos)): ?>
                    <a href="javascript:void(0);" onclick="confirmarDesinscripcion(<?php echo $evento['id']; ?>)">Desinscribirse</a>
                <?php else: ?>
                    <a href="javascript:void(0);" onclick="confirmarInscripcion(<?php echo $evento['id']; ?>)">Inscribirse</a>
                <?php endif; ?>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Sección Eventos Semanales -->
    <h2>Eventos Semanales</h2>
    <?php if (empty($eventos_semanales)): ?>
        <p>No hay eventos semanales disponibles.</p>
    <?php else: ?>
        <?php foreach ($eventos_semanales as $evento): ?>
            <div>
                <h3><?php echo htmlspecialchars($evento['titulo']); ?></h3>
                <p><strong>Fecha:</strong> <?php echo htmlspecialchars($evento['fecha']); ?></p>
                <p><strong>Hora:</strong> <?php echo htmlspecialchars($evento['hora']); ?></p>
                <p><strong>Lugar:</strong> <?php echo htmlspecialchars($evento['lugar']); ?></p>
                <p><?php echo $evento['descripcion']; ?></p>
                <a href="./inscripcion_eventos_semana.php?id_evento=<?php echo $evento['id']; ?>">Ver días disponibles</a>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>

    <script src="../../js/confirmarInscripcion.js"></script>
</body>
</html>