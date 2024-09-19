<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");

include_once('C:/laragon/www/gym-management/backend/config/db.php');


try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'])) {
        echo json_encode(["status" => "error", "message" => "ID no proporcionado"]);
        exit();
    }

    $id = $data['id'];
    $stmt = $pdo->prepare("DELETE FROM entrenadores WHERE entrenador_id = ?");
    $stmt->execute([$id]);
    
    echo json_encode(["status" => "success", "message" => "Entrenador eliminado con éxito"]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
