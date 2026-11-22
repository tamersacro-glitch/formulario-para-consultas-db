<?php
declare(strict_types=1);

$host = 'db'; ## aqui iria el host de la base de datos o dominio local
$db   = 'gestion_escolar'; ## aqui iria nombre de la base de datos
$user = 'usuario'; ## aqui iria el usuario de acceso a la base de datos
$pass = 'contraseña';## aqui iria la contraseña del usuario de acceso a la base de datos
$charset = 'utf8mb4';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=$charset",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

} catch (PDOException $e) {
    die("Error de conexi�n: " . $e->getMessage());
}