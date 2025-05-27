<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST['correo']);
    $contrasena = trim($_POST['contrasena']);

    if (empty($correo) || empty($contrasena)) {
        echo "<script>alert('Debes completar todos los campos.'); window.history.back();</script>";
        exit;
    }

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo "<script>alert('Usuario no encontrado.'); window.history.back();</script>";
        exit;
    }

    // Verificación sencilla de contraseña (ajusta según cómo guardas)
    if ($contrasena !== $usuario['contrasena']) {
        echo "<script>alert('Contraseña incorrecta.'); window.history.back();</script>";
        exit;
    }

    // Guardar datos en sesión
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['apellido'] = $usuario['apellido'];  // Asegúrate que exista en BD y consulta
    $_SESSION['correo'] = $usuario['correo'];

    echo "<script>alert('¡Inicio de sesión exitoso!'); window.location.href='../HTML/MainPage.html';</script>";
    exit;
}
?>


