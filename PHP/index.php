<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Bienvenido - Tour Vision</title>
</head>
<body>
  <h1>¡Hola, <?= htmlspecialchars($_SESSION['nombre']) ?>!</h1>
  <p>Has iniciado sesión correctamente.</p>
  <a href="logout.php">Cerrar sesión</a>
</body>
</html>
