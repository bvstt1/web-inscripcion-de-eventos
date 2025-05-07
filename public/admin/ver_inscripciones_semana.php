<?php
include("../../includes/conexion.php");

$idSemanal = intval($_GET['id_evento']);

// Obtener título del evento semanal
$sqlSemanal = "SELECT titulo FROM eventos WHERE id = $idSemanal";
$resSemanal = $enlace->query($sqlSemanal);
$titulo = $resSemanal->fetch_assoc()['titulo'];

// Obtener eventos diarios que pertenecen a esta semana
$sqlDiarios = "SELECT id, titulo FROM eventos WHERE tipo = 'diario' AND id_evento_padre = $idSemanal ORDER BY titulo";
$resultDiarios = $enlace->query($sqlDiarios);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Eventos de la semana</title>
</head>
<body>

    <h1>Eventos diarios de la semana: <?php echo htmlspecialchars($titulo); ?></h1>

    <?php if ($resultDiarios->num_rows > 0): ?>
        <ul>
            <?php while ($evento = $resultDiarios->fetch_assoc()): ?>
                <li>
                    <a href="inscritos_por_evento.php?id_evento=<?php echo $evento['id']; ?>">
                        <?php echo htmlspecialchars($evento['titulo']); ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No hay eventos diarios asociados a esta semana.</p>
    <?php endif; ?>

    <p><a href="./ver_inscripciones.php">← Volver</a></p>

    <?php $enlace->close(); ?>

</body>
</html>
