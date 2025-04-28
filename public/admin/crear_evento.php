<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Evento</title>
  <link rel="stylesheet" href="../css/crear_evento.css">
</head>
<body>

<div class="registro-container">

  <img src="../img/logo-uda.png" alt="Universidad de Atacama" class="logo-encabezado">

  <h2 class="titulo-admin">Crear evento</h2>

  <div class="tipo-evento">Tipo de evento</div>

  <form action="../php/guardar_evento.php" method="POST" class="formulario-crear">
    <input type="text" name="titulo" placeholder="Título de evento" required>
    <input type="date" name="fecha" placeholder="Fecha del evento" required>
    <input type="text" name="lugar" placeholder="Lugar del evento" required>
    <input type="time" name="hora" placeholder="Hora del evento" required>
    <textarea name="descripcion" placeholder="Descripción del evento" rows="4" required></textarea>
    <button type="submit" name="crear_evento" class="boton-crear">Crear</button>
  </form>

</div>

</body>
</html>

