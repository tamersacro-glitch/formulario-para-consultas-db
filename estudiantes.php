<?php
declare(strict_types=1);
require __DIR__ . '/conexion.php';

$stmt = $pdo->query('SELECT id_estudiante, nombre, apellido, fecha_nacimiento, correo
                     FROM estudiante ORDER BY id_estudiante DESC');
$estudiantes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estudiantes registrados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="container">
    <header class="header">
        <h1>Sistema de gestión escolar</h1>
        <p>Estudiantes registrados en la base de datos</p>
    </header>

    <?php if (isset($_GET['registrado'])): ?>
        <div class="success">¡Estudiante registrado correctamente!</div>
    <?php endif; ?>

    <section class="card">
        <h2>Listado de estudiantes</h2>
        <?php if (!$estudiantes): ?>
            <p>No hay estudiantes registrados.</p>
        <?php else: ?>
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th><th>Nombre</th><th>Apellido</th>
                        <th>Fecha de nacimiento</th><th>Correo</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($estudiantes as $alumno): ?>
                        <tr>
                            <td><?= htmlspecialchars((string)$alumno['id_estudiante']) ?></td>
                            <td><?= htmlspecialchars($alumno['nombre']) ?></td>
                            <td><?= htmlspecialchars($alumno['apellido']) ?></td>
                            <td><?= htmlspecialchars($alumno['fecha_nacimiento'] ?? '') ?></td>
                            <td><?= htmlspecialchars($alumno['correo'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        <a class="button-link" href="index.php">Registrar otro estudiante</a>
    </section>
</main>
</body>
</html>
