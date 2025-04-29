<?php
include("../../includes/conexion.php");

$sql = "SELECT * FROM eventos";
$resultado = mysqli_query($enlace, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver / Editar / Eliminar Evento</title>
    <link rel="stylesheet" href="../css/vee_eventos.css">
</head>
<body>

<div class="container">
    <header>
        <img src="../img/Universidad_de_Atacama_logo_(2020).svg.png" alt="Universidad de Atacama" class="logo">
        <h2>Ver / Editar / Eliminar Evento</h2>
    </header>

    <?php while ($evento = $resultado->fetch_assoc()): ?>
        <div class="evento-card">
            <h3><?php echo htmlspecialchars($evento['titulo']); ?></h3>
            <p class="fecha">Fecha: <?php echo htmlspecialchars($evento['fecha']); ?></p>
            <p class="hora">Hora: <?php echo htmlspecialchars($evento['hora']); ?></p>
            <p class="lugar">Lugar: <?php echo htmlspecialchars($evento['lugar']); ?></p>
            <p class="descripcion">Descripción: <?php echo htmlspecialchars($evento['descripcion']); ?></p>
            <div class="botones">
                <button class="editar" onclick="editarEvento(<?php echo $evento['id']; ?>)">Editar</button>
                <button class="eliminar" onclick="eliminarEvento(<?php echo $evento['id']; ?>)">Eliminar</button>
            </div>
        </div>
    <?php endwhile; ?>

</div>


</body>
</html>