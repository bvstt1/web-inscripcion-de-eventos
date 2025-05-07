<?php
include("../../includes/conexion.php");

$idEvento = intval($_GET['id_evento']);
$estudiantesInscritos = [];
$externosInscritos = [];

$sql = "SELECT e.id, e.rut, e.correo_inst AS correo, e.carrera, NULL AS institucion, NULL AS cargo, 'estudiante' AS tipo_usuario
        FROM estudiantes e
        INNER JOIN inscripciones i ON e.rut = i.rut_usuario
        WHERE i.id_evento = ?

        UNION ALL

        SELECT ex.id, ex.rut, ex.correo_ext AS correo, NULL AS carrera, ex.institucion, ex.cargo, 'externo' AS tipo_usuario
        FROM externos ex
        INNER JOIN inscripciones i ON ex.rut = i.rut_usuario
        WHERE i.id_evento = ?";

$stmt = $enlace->prepare($sql);
$stmt->bind_param("ii", $idEvento, $idEvento);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    if ($row['tipo_usuario'] === 'estudiante') {
        $estudiantesInscritos[] = $row;
    } elseif ($row['tipo_usuario'] === 'externo') {
        $externosInscritos[] = $row;
    }
}

$stmt->close();
$enlace->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscritos al Evento <?php echo $idEvento; ?></title>
</head>
<body>
    <h1>Inscritos al Evento <?php echo $idEvento; ?></h1>

    <p>
        <a href="../../php/generar_excel_inscritos.php?id_evento=<?php echo $idEvento; ?>" target="_blank">
            📥 Descargar Excel de inscritos
        </a>
    </p>

    <h2>Estudiantes Inscritos</h2>
    <?php if (!empty($estudiantesInscritos)): ?>
        <table>
            <thead>
                <tr>
                    <th>Rut</th>
                    <th>Email</th>
                    <th>Carrera</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudiantesInscritos as $estudiante): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($estudiante['rut']); ?></td>
                        <td><?php echo htmlspecialchars($estudiante['correo']); ?></td>
                        <td><?php echo htmlspecialchars($estudiante['carrera']); ?></td>
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay estudiantes inscritos en este evento.</p>
    <?php endif; ?>

    <h2>Externos Inscritos</h2>
    <?php if (!empty($externosInscritos)): ?>
        <table>
            <thead>
                <tr>
                    <th>Rut</th>
                    <th>Email</th>
                    <th>Institución</th>
                    <th>Cargo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($externosInscritos as $externo): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($externo['rut']); ?></td>
                        <td><?php echo htmlspecialchars($externo['correo']); ?></td>
                        <td><?php echo htmlspecialchars($externo['institucion']); ?></td>
                        <td><?php echo htmlspecialchars($externo['cargo']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay externos inscritos en este evento.</p>
    <?php endif; ?>

</body>
</html>