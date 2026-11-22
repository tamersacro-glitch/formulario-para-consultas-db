<?php
declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

require __DIR__ . '/conexion.php';

$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$fecha = trim($_POST['fecha_nacimiento'] ?? '');
$correo = trim($_POST['correo'] ?? '');

if ($nombre === '' || $apellido === '') {
    exit('Nombre y apellido son obligatorios. <a href="index.php">Regresar</a>');
}
if ($correo !== '' && !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    exit('El correo no tiene un formato válido. <a href="index.php">Regresar</a>');
}

try {
    $sql = 'INSERT INTO estudiante (nombre, apellido, fecha_nacimiento, correo)
            VALUES (:nombre, :apellido, :fecha_nacimiento, :correo)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':fecha_nacimiento' => $fecha !== '' ? $fecha : null,
        ':correo' => $correo !== '' ? $correo : null,
    ]);
    header('Location: estudiantes.php?registrado=1');
    exit;
} catch (PDOException $e) {
    if ((string)$e->getCode() === '23000') {
        exit('Ese correo ya está registrado. <a href="index.php">Regresar</a>');
    }
    http_response_code(500);
    exit('Ocurrió un error al guardar el registro.');
}
