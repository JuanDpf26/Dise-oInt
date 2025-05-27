<?php
session_start();
header('Content-Type: application/json'); // Asegura que el contenido sea JSON

if (!isset($_SESSION['correo'])) {
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit;
}

$correo = $_SESSION['correo'];

$host = 'localhost';
$usuario = 'root';
$clave = '';
$bd = 'tour_vision';

$conn = new mysqli($host, $usuario, $clave, $bd);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Error de conexión']);
    exit;
}

$sql = "SELECT nombre, apellido, correo FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    echo json_encode($usuario);
} else {
    echo json_encode(['error' => 'Usuario no encontrado']);
}

$stmt->close();
$conn->close();
?>
