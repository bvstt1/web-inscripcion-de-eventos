<?php
include("../../includes/conexion.php");

$sql = "SELECT * FROM eventos";
$resultado = mysqli_query($enlace, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Eventos</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            width: 300px;
            display: inline-block;
            vertical-align: top;
            box-shadow: 2px 2px 12px rgba(0,0,0,0.1);
        }
        .card h3 {
            margin-top: 0;
        }
        .card a {
            margin-right: 10px;
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>

<h2>Listado de Eventos</h2>

<?php while($evento = mysqli_fetch_assoc($resultado)) { ?>
    <div class="card">
        <h3><?php echo htmlspecialchars($evento['titulo']); ?></h3>
        <p><strong>Fecha:</strong> <?php echo htmlspecialchars($evento['fecha']); ?></p>
        <p><strong>Hora:</strong> <?php echo htmlspecialchars($evento['hora']); ?></p>
        <p><strong>Lugar:</strong> <?php echo htmlspecialchars($evento['lugar']); ?></p>
        <p><?php echo htmlspecialchars($evento['descripcion']); ?></p>
        <a href="editar_evento.php?id=<?php echo $evento['id']; ?>">Editar</a> |
        <a href="../../php/eliminar_evento.php?id=<?php echo $evento['id']; ?>" onclick="return confirm('¿Seguro que deseas eliminar este evento?');">Eliminar</a>
    </div>
<?php } ?>

</body>
</html>
