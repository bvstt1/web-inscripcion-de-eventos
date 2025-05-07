<?php
include("../../includes/conexion.php");

// Obtener todos los eventos con su tipo y relación
$sqlEventos = "SELECT id, titulo, tipo, id_evento_padre FROM eventos ORDER BY tipo, titulo";
$resultEventos = $enlace->query($sqlEventos);

// Separar eventos
$eventosDiariosAislados = [];
$eventosSemanales = [];

while ($evento = $resultEventos->fetch_assoc()) {
    if ($evento['tipo'] === 'diario' && is_null($evento['id_evento_padre'])) {
        $eventosDiariosAislados[] = $evento;
    } elseif ($evento['tipo'] === 'semanal') {
        $eventosSemanales[] = $evento;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Eventos</title>
</head>
<body>

    <h1>Seleccione un Evento para Ver los Inscritos</h1>

    <?php if (!empty($eventosDiariosAislados)): ?>
        <h2>Eventos Diarios Aislados</h2>
        <ul>
            <?php foreach ($eventosDiariosAislados as $evento): ?>
                <li>
                    <a href="inscritos_por_evento.php?id_evento=<?php echo $evento['id']; ?>">
                        <?php echo htmlspecialchars($evento['titulo']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay eventos diarios aislados disponibles.</p>
    <?php endif; ?>

    <?php if (!empty($eventosSemanales)): ?>
        <h2>Eventos Semanales</h2>
        <ul>
            <?php foreach ($eventosSemanales as $evento): ?>
                <li>
                <a href="ver_inscripciones_semana.php?id_evento=<?php echo $evento['id']; ?>">
                        <?php echo htmlspecialchars($evento['titulo']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay eventos semanales disponibles.</p>
    <?php endif; ?>

    <?php $enlace->close(); ?>

</body>
</html>
