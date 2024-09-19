<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Manejar la solicitud OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$host = 'localhost';
$db = 'gym_management';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtén los datos de la solicitud
    $data = json_decode(file_get_contents("php://input"));

    // Verifica si los datos son válidos
    if (isset($data->nombre, $data->especialidad, $data->telefono, $data->email)) {
        $nombre = $data->nombre;
        $especialidad = $data->especialidad;
        $telefono = $data->telefono;
        $email = $data->email;

        // Prepara la consulta SQL
        $stmt = $pdo->prepare("INSERT INTO entrenadores (nombre, especialidad, telefono, email) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombre, $especialidad, $telefono, $email]);

        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
    }

} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
