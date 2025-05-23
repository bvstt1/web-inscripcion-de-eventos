
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
  <link rel="stylesheet" href="../css/admin_panel.css">
</head>
<body>

<div class="registro-container">

  <img src="../img/Universidad_de_Atacama_logo_(2020).svg.png" alt="Universidad de Atacama" class="logo-encabezado">

  <h2 class="titulo-admin">Administrador</h2>

  <div class="admin-opciones">
    <a href="./crear_evento.php" class="admin-boton">Crear Evento</a>
    <a href="./vee_evento.php" class="admin-boton">Ver / Editar / Eliminar Evento</a>
    <a href="./asistencia_eventos.php" class="admin-boton">Asistencia eventos</a>
  </div>
  <a href="../../php/logout.php">Cerrar sesión</a>
 
</div>

</body>
</html>

