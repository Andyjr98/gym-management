<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type");

include_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

// Verifica si $data es null
if ($data === null) {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "Error al decodificar JSON."]);
    exit;
}

// Verifica que se proporcionen todos los campos necesarios
if (!isset($data['miembro_id'], $data['entrenador_id'], $data['fecha'], $data['duracion'], $data['sesion_id'])) {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "Datos incompletos."]);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE sesiones SET miembro_id = ?, entrenador_id = ?, fecha = ?, duracion = ? WHERE sesion_id = ?");
    $stmt->execute([$data['miembro_id'], $data['entrenador_id'], $data['fecha'], $data['duracion'], $data['sesion_id']]);
    
    echo json_encode(["success" => "Sesión actualizada con éxito."]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error al actualizar: " . $e->getMessage()]);
}
?>
