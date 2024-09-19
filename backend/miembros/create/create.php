<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: POST, OPTIONS");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$db = 'gym_management';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

    // Obtener los datos JSON
    $data = json_decode(file_get_contents("php://input"));

    // Comprobar que los datos requeridos están presentes
    if (!isset($data->nombre) || !isset($data->apellido) || !isset($data->fecha_nacimiento) || !isset($data->tipo_membresia)) {
        echo json_encode(["error" => "Datos incompletos."]);
        exit;
    }

    // Preparar la consulta
    $stmt = $pdo->prepare("INSERT INTO miembros (nombre, apellido, fecha_nacimiento, tipo_membresia) VALUES (?, ?, ?, ?)");
    $stmt->execute([$data->nombre, $data->apellido, $data->fecha_nacimiento, $data->tipo_membresia]);

    // Solo envía JSON como respuesta
    echo json_encode(["message" => "Miembro creado con éxito"]);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
