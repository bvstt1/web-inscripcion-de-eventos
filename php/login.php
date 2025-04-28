<?php
include("../includes/conexion.php");

session_start(); // Iniciamos sesión por si después quieres usarla

if (isset($_POST['login'])) {
    $rut = $_POST['rut'];
    $contrasena = $_POST['contrasena'];

    // Buscar primero en administradores
    $sqlAdmin = "SELECT * FROM admins WHERE rut = '$rut'";
    $resultadoAdmin = mysqli_query($enlace, $sqlAdmin);

    if (mysqli_num_rows($resultadoAdmin) > 0) {
        $admin = mysqli_fetch_assoc($resultadoAdmin);

        if (password_verify($contrasena, $admin['contrasena'])) {
            $_SESSION['rut'] = $admin['rut'];
            $_SESSION['tipo_usuario'] = 'admin';
            header("Location: ../public/admin/admin_panel.php");
            exit();
        } else {
            echo "❌ Contraseña incorrecta para administrador.";
        }
    } else {
        // Buscar en estudiantes
        $sqlEstudiantes = "SELECT * FROM estudiantes WHERE rut = '$rut'";
        $resultadoEstudiantes = mysqli_query($enlace, $sqlEstudiantes);

        if (mysqli_num_rows($resultadoEstudiantes) > 0) {
            $usuario = mysqli_fetch_assoc($resultadoEstudiantes);

            if (password_verify($contrasena, $usuario['contrasena'])) {
                $_SESSION['rut'] = $usuario['rut'];
                $_SESSION['tipo_usuario'] = 'estudiante';
                header("Location: ../public/user/inscripcion_a_eventos.php");
            } else {
                echo "❌ Contraseña incorrecta para estudiante.";
            }
        } else {
            // Buscar en externos
            $sqlExternos = "SELECT * FROM externos WHERE rut = '$rut'";
            $resultadoExternos = mysqli_query($enlace, $sqlExternos);

            if (mysqli_num_rows($resultadoExternos) > 0) {
                $usuario = mysqli_fetch_assoc($resultadoExternos);

                if (password_verify($contrasena, $usuario['contrasena'])) {
                    $_SESSION['rut'] = $usuario['rut'];
                    $_SESSION['tipo_usuario'] = 'externo';
                    header("Location: ../public/user/inscripcion_a_eventos.php");
                } else {
                    echo "❌ Contraseña incorrecta para usuario externo.";
                }
            } else {
                echo "❌ RUT no registrado en el sistema.";
            }
        }
    }
}
?>
