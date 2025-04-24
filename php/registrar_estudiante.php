<?php
include("../includes/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = $conexion->real_escape_string($_POST['rut']);
    $correo = $conexion->real_escape_string($_POST['correo']);
    $carrera = $conexion->real_escape_string($_POST['carrera']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO estudiantes (rut, correo_inst, carrera, contraseña)
            VALUES ('$rut', '$correo', '$carrera', '$contrasena')";

    if ($conexion->query($sql) === TRUE) {
        echo "✅ Registrado correctamente.";
    } else {
        echo "❌ Error: " . $conexion->error;
    }

    $conexion->close();
}
?>