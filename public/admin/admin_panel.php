
<?php
session_start();

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header("Location: ../index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Administrador</title>
</head>
<body>

  <img src="./img/Universidad_de_Atacama_logo_(2020).svg.png" alt="Universidad de Atacama">

  <h2>Administrador</h2>

  <a href="./crear_evento.php">Crear Evento</a><br>
  <a href="./vee_evento.php">Ver / Editar / Eliminar Evento</a><br>
  <a href="asistencia_eventos.php">Asistencia eventos</a><br>

  <a href="../../php/logout.php">Cerrar sesión</a>


</body>
</html>
