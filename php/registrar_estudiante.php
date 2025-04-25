<?php
include("../includes/conexion.php");

if (isset($_POST['registro-est'])) {
    $rut = mysqli_real_escape_string($enlace, $_POST['rut']);
    $correo = mysqli_real_escape_string($enlace, $_POST['correo']);
    $carrera = mysqli_real_escape_string($enlace, $_POST['carrera']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO estudiantes (rut, correo_inst, carrera, contrasena)
                      VALUES ('$rut', '$correo', '$carrera', '$contrasena')";


    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $insert = mysqli_query($enlace, $sql);

    if ($insert) {
        header("Location: ../public/registro_estudiante.php?exito=1");
        exit();
    } else {
        header("Location: ../public/registro_estudiante.php?error=1");
        exit();
    }
}
?>
