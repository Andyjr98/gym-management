<?php
include_once '../config/db.php'; // Asegúrate de que la ruta sea correcta

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: DELETE");

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)) {
    $id = $data->id;

    $stmt = $pdo->prepare("DELETE FROM entrenadores WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "ID no proporcionado"]);
}
?>
