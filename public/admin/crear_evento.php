<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Evento</title>
</head>
<body>

  <img src="../img/logo-uda.png" alt="Universidad de Atacama">
  <h2>Crear evento</h2>

  <form action="../php/guardar_evento.php" method="POST">

    <label for="tipo_evento">Tipo de evento</label><br>
    <select id="tipo_evento" name="tipo_evento" required>
      <option value="">Seleccionar tipo</option>
      <option value="Conferencia">Semanal</option>
      <option value="Charla">Diario</option>
    </select><br><br>

    <input type="text" name="titulo" placeholder="Título de evento" required><br><br>
    <input type="date" name="fecha" placeholder="Fecha del evento" required><br><br>
    <input type="text" name="lugar" placeholder="Lugar del evento" required><br><br>
    <input type="time" name="hora" placeholder="Hora del evento" required><br><br>
    <textarea name="descripcion" placeholder="Descripción del evento" rows="4" required></textarea><br><br>

    <button type="submit" name="crear_evento">Crear</button>
  </form>

</body>
</html>
