<?php
include("../../includes/conexion.php");
session_start();

// Comprobar si el usuario está logueado
if (!isset($_SESSION['rut'])) {
    header("Location: ../../index.html");
    exit();
}

// Traer todos los eventos
$sql = "SELECT * FROM eventos";
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eventos Disponibles</title>
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
                <p><?php echo htmlspecialchars($evento['descripcion']); ?></p>
                <a href="javascript:void(0);" onclick="confirmarInscripcion(<?php echo $evento['id']; ?>)">Inscribirse</a>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Sección Eventos Semanales -->
    <h2>Eventos Semanales</h2>
    <?php if (empty($eventos_semanales)): ?>
        <p>No hay eventos semanales disponibles.</p>
    <?php else: ?>
        <?php foreach ($eventos_diarios as $evento): ?>
        <div>
            <h3><?php echo htmlspecialchars($evento['titulo']); ?></h3>
            <p><strong>Fecha:</strong> <?php echo htmlspecialchars($evento['fecha']); ?></p>
            <p><strong>Hora:</strong> <?php echo htmlspecialchars($evento['hora']); ?></p>
            <p><strong>Lugar:</strong> <?php echo htmlspecialchars($evento['lugar']); ?></p>
            <p><?php echo htmlspecialchars($evento['descripcion']); ?></p>
            <a href="javascript:void(0);" onclick="confirmarInscripcion(<?php echo $evento['id']; ?>)">Inscribirse</a>

        </div>
        <hr>
    <?php endforeach; ?>
    <?php endif; ?>
<script src="../../js/confirmarInscripcion.js"></script>
</body>
</html>
