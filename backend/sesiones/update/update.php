<?php
include_once __DIR__ . '/../../config/db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id) && isset($data->idMiembro) && isset($data->idEntrenador) && isset($data->fecha) && isset($data->duracion)) {
    $id = $data->id;
    $idMiembro = $data->idMiembro;
    $idEntrenador = $data->idEntrenador;
    $fecha = $data->fecha;
    $duracion = $data->duracion;

    $query = "UPDATE sesiones SET idMiembro = ?, idEntrenador = ?, fecha = ?, duracion = ? WHERE id = ?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("iisii", $idMiembro, $idEntrenador, $fecha, $duracion, $id);
        
        if ($stmt->execute()) {
            echo json_encode(["message" => "Sesión actualizada."]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Error al actualizar la sesión."]);
        }
        
        $stmt->close();
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Error en la consulta."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Entrada inválida."]);
}

$conn->close();
?>
