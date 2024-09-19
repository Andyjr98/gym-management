<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: POST, OPTIONS");

// Manejo de solicitudes OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); // No Content
    exit;
}

include_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

// Verifica que los datos no estén vacíos
if (is_null($data) || !isset($data['miembro_id']) || !isset($data['entrenador_id']) || !isset($data['fecha']) || !isset($data['duracion'])) {
    http_response_code(400);
    echo json_encode(["error" => "Datos incompletos."]);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO sesiones (miembro_id, entrenador_id, fecha, duracion) VALUES (?, ?, ?, ?)");
    $stmt->execute([$data['miembro_id'], $data['entrenador_id'], $data['fecha'], $data['duracion']]);
    
    echo json_encode(["success" => "Sesión creada con éxito."]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error al crear la sesión: " . $e->getMessage()]);
}
?>
