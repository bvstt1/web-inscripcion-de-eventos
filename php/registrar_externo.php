<?php
include("../includes/conexion.php");

if (isset($_POST['registro-ext'])) {
    $rut = mysqli_real_escape_string($enlace, $_POST['rut']);
    $correo = mysqli_real_escape_string($enlace, $_POST['correo']);
    $institucion = mysqli_real_escape_string($enlace, $_POST['institucion']);
    $cargo = mysqli_real_escape_string($enlace, $_POST['cargo']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO externos (rut, correo_ext, institucion, cargo, contrasena)
                      VALUES ('$rut', '$correo', '$institucion', '$cargo', '$contrasena')";


    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $insert = mysqli_query($enlace, $sql);

    if ($insert) {
        header("Location: ../public/registro_externo.html?exito=1");
        exit();
    } else {
        header("Location: ../public/registro_externo.html?error=1");
        exit();
    }
}
?>
