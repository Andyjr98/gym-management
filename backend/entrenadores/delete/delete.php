<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

try {
    $stmt = $pdo->prepare("DELETE FROM entrenadores WHERE entrenador_id = ?");
    $stmt->execute([$data['entrenador_id']]);
    
    echo json_encode(["success" => "Entrenador eliminado con éxito."]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error al eliminar: " . $e->getMessage()]);
}
?>
