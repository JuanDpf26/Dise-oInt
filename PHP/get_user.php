<?php
session_start();

header('Content-Type: application/json');

if (isset($_SESSION['nombre']) && isset($_SESSION['apellido'])) {
    echo json_encode([
        'nombre' => $_SESSION['nombre'],
        'apellido' => $_SESSION['apellido']
    ]);
} else {
    // No hay usuario logueado
    echo json_encode([]);
}
?>

