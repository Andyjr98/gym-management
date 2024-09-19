<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: PUT, OPTIONS");

$host = 'localhost';
$db = 'gym_management';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $data = json_decode(file_get_contents("php://input"));
    $stmt = $pdo->prepare("UPDATE miembros SET nombre = ?, apellido = ?, fecha_nacimiento = ?, tipo_membresia = ? WHERE id = ?");
    $stmt->execute([$data->nombre, $data->apellido, $data->fecha_nacimiento, $data->tipo_membresia, $data->id]);
    echo json_encode(["message" => "Miembro actualizado con éxito"]);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
