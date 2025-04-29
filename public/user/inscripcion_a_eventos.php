<?php
include("../../includes/conexion.php");
session_start();

// Verificar sesión
if (!isset($_SESSION['rut'])) {
    header("Location: ../../index.html");
    exit();
}

// Obtener eventos
$sql = "SELECT * FROM eventos";
$resultado = mysqli_query($enlace, $sql);

$eventos_diarios = [];
$eventos_semanales = [];

while ($evento = mysqli_fetch_assoc($resultado)) {
    if ($evento['tipo'] == 'diario') {
        $eventos_diarios[] = $evento;
    } elseif ($evento['tipo'] == 'semanal') {
        $eventos_semanales[] = $evento;
    }
}

// Obtener eventos inscritos por el usuario
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
    <title>Registro de Asistencia</title>
    <link rel="stylesheet" href="../css/inscripcion_a_eventos.css">
</head>
<body>

<div class="container">
    <header class="encabezado">
        <img src="../img/Universidad_de_Atacama_logo_(2020).svg.png" alt="Universidad de Atacama" class="logo">
        <h2>Registro de asistencia</h2>
        <p>Bienvenido/a <strong><?php echo $_SESSION['nombre_apellido'] ?? 'Usuario'; ?></strong></p>
        <p>Aquí puedes ver y registrar tu asistencia a los eventos.</p>
    </header>

    <!-- Eventos Semanales -->
    <h2>Eventos Semanales</h2>
    <?php if (empty($eventos_semanales)): ?>
        <p>No hay eventos semanales disponibles.</p>
    <?php else: ?>
        <?php foreach ($eventos_semanales as $evento): ?>
            <div class="card gris">
                <h3><?php echo $evento['titulo']; ?></h3>
                <p><strong>Evento Semanal</strong></p>
                <p>Fecha: <?php echo $evento['fecha'] ; ?></p>
                <p><?php echo $evento['descripcion']; ?></p>
                <a href="#" class="btn verde">Ver Sub - Eventos</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Eventos Diarios -->
    <h2>Eventos Diarios</h2>
    <?php if (empty($eventos_diarios)): ?>
        <p>No hay eventos diarios disponibles.</p>
    <?php else: ?>
        <?php foreach ($eventos_diarios as $evento): ?>
            <?php
            $inscrito = in_array($evento['id'], $eventos_inscritos);
            $clase_color = $inscrito ? 'rojo' : 'amarillo';
            $texto_boton = $inscrito ? 'Inscrito' : 'Inscribirse';
            ?>
            <div class="card <?php echo $clase_color; ?>">
                <h3><?php echo $evento['titulo']; ?></h3>
                <p>Lugar: <?php echo $evento['lugar']; ?></p>
                <p>Fecha: <?php echo $evento['fecha']; ?></p>
                <p>Hora: <?php echo $evento['hora']; ?></p>
                <p><?php echo $evento['descripcion']; ?></p>
                <a href="#" class="btn verde"><?php echo $texto_boton; ?></a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>
