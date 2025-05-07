<?php
include("../includes/conexion.php");

if (isset($_POST['registro-est'])) {
    $rut = mysqli_real_escape_string($enlace, $_POST['rut']);
    $correo = mysqli_real_escape_string($enlace, $_POST['correo']);
    $carrera = mysqli_real_escape_string($enlace, $_POST['carrera']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    // Verificar si ya existe el RUT o correo
    $verificar_sql = "SELECT * FROM estudiantes WHERE rut = '$rut' OR correo_inst = '$correo'";
    $verificar_resultado = mysqli_query($enlace, $verificar_sql);

    if (mysqli_num_rows($verificar_resultado) > 0) {
        // El RUT o correo ya está registrado
        header("Location: ../public/registro_estudiante.html?error=duplicado");
        exit();
    }

    // Si no existe, insertar
    $sql = "INSERT INTO estudiantes (rut, correo_inst, carrera, contrasena)
                      VALUES ('$rut', '$correo', '$carrera', '$contrasena')";

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $insert = mysqli_query($enlace, $sql);

    if ($insert) {
        header("Location: ../public/registro_estudiante.html?exito=1");
        exit();
    } else {
        header("Location: ../public/registro_estudiante.html?error=1");
        exit();
    }
}
?> 

