<?php
// Conexión a la base de datos
$host = "localhost";
$dbname = "tour_vision";
$username = "root";
$password = "";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}

// Validar y registrar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST['correo']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $contrasena = trim($_POST['contrasena']); // Asegúrate que el input en HTML sea "contrasena"

    if (empty($correo) || empty($nombre) || empty($apellido) || empty($contrasena)) {
        echo "<script>alert('Todos los campos son obligatorios.'); window.history.back();</script>";
        exit;
    }

    // Verificar si ya existe el correo
    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $stmt->execute([$correo]);

    if ($stmt->rowCount() > 0) {
        echo "<script>alert('El correo ya está registrado.'); window.history.back();</script>";
        exit;
    }

    // Registrar nuevo usuario con contraseña sin encriptar (NO recomendado en producción)
    $stmt = $conexion->prepare("INSERT INTO usuarios (correo, nombre, apellido, contrasena) VALUES (?, ?, ?, ?)");
    $stmt->execute([$correo, $nombre, $apellido, $contrasena]);

    echo "<script>alert('¡Registro exitoso! Ahora puedes iniciar sesión.'); window.location.href='../HTML/InicioSesion.html';</script>";
}
?>

