<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

include_once '../config/db.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->idMiembro, $data->idEntrenador, $data->fecha, $data->duracion)) {
    $idMiembro = $data->idMiembro;
    $idEntrenador = $data->idEntrenador;
    $fecha = $data->fecha;
    $duracion = $data->duracion;

    $stmt = $pdo->prepare("INSERT INTO sesiones (idMiembro, idEntrenador, fecha, duracion) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$idMiembro, $idEntrenador, $fecha, $duracion])) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al agregar sesión"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
}
?>
