<?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
  
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");

$host = 'localhost';
$db = 'gym_management';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $data = json_decode(file_get_contents("php://input"));
    $stmt = $pdo->prepare("DELETE FROM miembros WHERE id = ?");
    $stmt->execute([$data->id]);
    echo json_encode(["message" => "Miembro eliminado con éxito"]);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
