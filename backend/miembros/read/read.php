<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, OPTIONS");

$host = 'localhost';
$db = 'gym_management';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $stmt = $pdo->query("SELECT * FROM miembros");
    $miembros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($miembros);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
