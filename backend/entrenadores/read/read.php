<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include_once '../../config/db.php';

try {
    $query = "SELECT * FROM entrenadores";
    $stmt = $pdo->query($query);
    
    $entrenadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($entrenadores);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error en la consulta: " . $e->getMessage()]);
}
?>
