<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Manejo de solicitudes OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); // No Content
    exit;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$db = 'gym_management';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $stmt = $pdo->prepare("SELECT * FROM sesiones");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => $e->getMessage()]);
}
?>
