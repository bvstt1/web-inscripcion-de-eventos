<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "app-uda-inscripcion";
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <div>
        <form action="" method="POST">
            <label>RUT</label>
            <input type="text" name="rut" required>

            <label>Correo Institucional</label>
            <input type="email" name="correo" required>

            <label>Selecciona tu carrera</label>
            <select name="carrera" required>
                <option value="Ingeniería Civil en Computación e Informática">Ingeniería Civil en Computación e Informática</option>
            </select>

            <label>Contraseña</label>
            <input type="password" name="contrasena" required>

            <input type="submit" value="Registrar" name="registro-est">
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['registro-est'])) {
    $rut = mysqli_real_escape_string($enlace, $_POST['rut']);
    $correo = mysqli_real_escape_string($enlace, $_POST['correo']);
    $carrera = mysqli_real_escape_string($enlace, $_POST['carrera']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    echo $rut . ' - ' . $correo . ' - ' . $carrera . ' - ' . $contrasena;

    $insertarDatos = "INSERT INTO estudiantes (rut, correo_inst, carrera, contrasena)
                      VALUES ('$rut', '$correo', '$carrera', '$contrasena')";


    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $ejecutarInsertar = mysqli_query($enlace, $insertarDatos);

    if ($ejecutarInsertar) {
        echo "Usuario registrado correctamente.";
    } else {
        echo "Error al registrar: " . mysqli_error($enlace);
    }
}


?>
