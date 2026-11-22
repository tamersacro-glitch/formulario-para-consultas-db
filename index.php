<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de estudiantes | Gestión escolar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="container">
    <header class="header">
        <h1>Sistema de gestión escolar</h1>
        <p>Formulario de registro de estudiantes</p>
    </header>

    <section class="card">
        <h2>Registrar estudiante</h2>
        <form action="registrar_estudiante.php" method="post">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" maxlength="100" required>

            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="apellido" maxlength="100" required>

            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento">

            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" maxlength="150">

            <button type="submit">Registrar estudiante</button>
        </form>
        <a class="secondary-link" href="estudiantes.php">Ver estudiantes registrados</a>
    </section>
</main>
</body>
</html>
