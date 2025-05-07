<?php
include("../../includes/conexion.php");
$query_semanales = "SELECT id, titulo, fecha FROM eventos WHERE tipo = 'semanal'";
$result_semanales = mysqli_query($enlace, $query_semanales);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Evento</title>
  <link rel="stylesheet" href="../css/crear_evento.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>
<body>

<div class="registro-container">
  <img src="../img/Universidad_de_Atacama_logo_(2020).svg.png" alt="Universidad de Atacama" class="logo-encabezado">

  <h2 class="titulo-admin">Crear evento</h2>

  <form action="../../php/guardar_evento.php" method="POST" class="formulario-crear">

    <!-- Tipo de evento -->
    <label for="tipo">Tipo de evento</label>
    <select id="tipo" name="tipo" required>
      <option value="semanal">Semanal</option>
      <option value="diario">Diario</option>
    </select>

    <!-- Selector de evento padre -->
    <div id="selector-evento-padre" style="display: none;">
      <label for="evento_padre">¿A qué evento semanal pertenece?</label>
      <select name="evento_padre" id="evento_padre">
        <option value="">(Evento diario sin semana asociada)</option>
        <?php while ($evento = mysqli_fetch_assoc($result_semanales)): ?>
          <option value="<?php echo $evento['id']; ?>">
            <?php echo htmlspecialchars($evento['titulo'] . " (" . $evento['fecha'] . ")"); ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <!-- Título -->
    <input type="text" name="titulo" placeholder="Título del evento" required>

    <!-- Fecha -->
    <input type="text" name="fecha" id="fecha" placeholder="Selecciona fecha" required>
    <div id="ayuda-semanal" style="display: none; font-size: 0.9em; color: #555;">
      * Para eventos semanales, selecciona el <strong>lunes</strong> de la semana.<br>
    </div>
    <div id="info-fechas-semana" style="display: none; font-size: 0.9em; color: #333;"></div>

    <!-- Lugar y hora -->
    <input type="text" name="lugar" placeholder="Lugar del evento" required>
    <div id="hora-container">
      <label for="hora">Hora</label>
      <input type="time" name="hora" id="hora" required>
    </div>

    <!-- Descripción -->
    <textarea name="descripcion" id="descripcion" placeholder="Descripción del evento" rows="4"></textarea>

    <!-- Botón -->
    <button type="submit" name="crear_evento" class="boton-crear">Crear</button>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="../../js/crear_evento.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
  let editor;

  ClassicEditor
    .create(document.querySelector('#descripcion'))
    .then(newEditor => {
      editor = newEditor;
    })
    .catch(error => {
      console.error('Error al cargar CKEditor:', error);
    });

  document.querySelector('form').addEventListener('submit', function () {
    document.querySelector('#descripcion').value = editor.getData();
  });
</script>

</body>
</html>
