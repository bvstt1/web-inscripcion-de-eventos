<?php
include("../includes/conexion.php");

if (isset($_GET['evento_padre'])) {
    $id_padre = intval($_GET['evento_padre']);

    // Obtener fecha del evento semanal
    $query = "SELECT fecha FROM eventos WHERE id = $id_padre AND tipo = 'semanal'";
    $result = mysqli_query($enlace, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $fecha_lunes = $row['fecha'];
        $inicio = date('Y-m-d', strtotime($fecha_lunes));
        $fin = date('Y-m-d', strtotime("$fecha_lunes +6 days"));

        // Buscar eventos diarios hijos en esa semana
        $queryDias = "SELECT fecha FROM eventos 
                      WHERE id_evento_padre = $id_padre 
                      AND fecha BETWEEN '$inicio' AND '$fin'";
        $resultDias = mysqli_query($enlace, $queryDias);

        $ocupados = [];
        while ($fila = mysqli_fetch_assoc($resultDias)) {
            $ocupados[] = $fila['fecha'];
        }

        echo json_encode([
            "inicio" => $inicio,
            "fin" => $fin,
            "ocupados" => $ocupados
        ]);
    } else {
        echo json_encode(["error" => "Evento semanal no encontrado"]);
    }
} else {
    echo json_encode(["error" => "Falta parámetro"]);
}
