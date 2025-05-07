<?php
// Asegura que no haya espacios antes del PHP
require __DIR__ . '/../vendor/autoload.php';
include("../includes/conexion.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Validar id_evento
if (!isset($_GET['id_evento']) || !is_numeric($_GET['id_evento'])) {
    die("ID de evento no válido.");
}

$idEvento = intval($_GET['id_evento']);
$estudiantes = [];
$externos = [];

// Consulta combinada para estudiantes y externos
$sql = "SELECT e.rut, e.correo_inst AS correo, e.carrera, NULL AS institucion, NULL AS cargo, 'estudiante' AS tipo_usuario
        FROM estudiantes e
        INNER JOIN inscripciones i ON e.rut = i.rut_usuario
        WHERE i.id_evento = ?
        UNION ALL
        SELECT ex.rut, ex.correo_ext AS correo, NULL AS carrera, ex.institucion, ex.cargo, 'externo' AS tipo_usuario
        FROM externos ex
        INNER JOIN inscripciones i ON ex.rut = i.rut_usuario
        WHERE i.id_evento = ?";

$stmt = $enlace->prepare($sql);
$stmt->bind_param("ii", $idEvento, $idEvento);
$stmt->execute();
$result = $stmt->get_result();

// Separar datos en arrays distintos
while ($row = $result->fetch_assoc()) {
    if ($row['tipo_usuario'] === 'estudiante') {
        $estudiantes[] = $row;
    } elseif ($row['tipo_usuario'] === 'externo') {
        $externos[] = $row;
    }
}

$stmt->close();
$enlace->close();

// Crear archivo Excel
$spreadsheet = new Spreadsheet();

// Hoja 1: Estudiantes
$sheet1 = $spreadsheet->getActiveSheet();
$sheet1->setTitle('Estudiantes');
$sheet1->fromArray(['RUT', 'Correo', 'Carrera'], NULL, 'A1');
$row = 2;
foreach ($estudiantes as $e) {
    $sheet1->setCellValue("A{$row}", $e['rut']);
    $sheet1->setCellValue("B{$row}", $e['correo']);
    $sheet1->setCellValue("C{$row}", $e['carrera']);
    $row++;
}

// Hoja 2: Externos
$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('Externos');
$sheet2->fromArray(['RUT', 'Correo', 'Institución', 'Cargo'], NULL, 'A1');
$row = 2;
foreach ($externos as $x) {
    $sheet2->setCellValue("A{$row}", $x['rut']);
    $sheet2->setCellValue("B{$row}", $x['correo']);
    $sheet2->setCellValue("C{$row}", $x['institucion']);
    $sheet2->setCellValue("D{$row}", $x['cargo']);
    $row++;
}

// Configurar headers para descarga
$filename = "inscritos_evento_{$idEvento}.xlsx";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
