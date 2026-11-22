# Sistema de Gestión Escolar

Aplicación web desarrollada en PHP para trabajar con información de un sistema de gestión escolar mediante una base de datos MySQL. El proyecto permite registrar estudiantes desde un formulario web y consultar información académica almacenada en tablas relacionadas.

## Funcionalidades

- Registro de estudiantes mediante un formulario web.
- Validación de campos obligatorios y del formato del correo electrónico.
- Almacenamiento de estudiantes en MySQL mediante PDO.
- Consulta y visualización de estudiantes registrados.
- Consultas SQL que relacionan estudiantes, matrículas, materias y evaluaciones.
- Actualización de calificaciones mediante consultas `UPDATE`.
- Visualización de resultados en phpMyAdmin.

## Tecnologías utilizadas

- PHP
- MySQL 8.4
- PDO (PHP Data Objects)
- Apache
- phpMyAdmin
- Docker Compose

## Base de datos

El proyecto utiliza la base de datos `gestion_escolar`. Entre las tablas utilizadas en las consultas se encuentran:

- `estudiante`: información de los estudiantes.
- `materia`: datos de las materias.
- `matricula`: relación entre estudiantes y materias, con periodo y fecha de matrícula.
- `evaluacion`: evaluaciones, calificaciones y fechas, asociadas a una matrícula.

Las consultas SQL utilizan relaciones entre tablas mediante `INNER JOIN` para recuperar información académica.

## Configuración de conexión

El archivo `conexion.php` centraliza la conexión a MySQL mediante PDO. Si PHP se ejecuta dentro del contenedor `web` definido en Docker Compose, el servidor de base de datos debe indicarse con el nombre del servicio `db` y el puerto interno `3306` (no el puerto publicado `3316`).

Ejemplo de configuración — sustituye las credenciales por las que estén definidas en tu entorno:

```php
<?php
$host = 'db';
$dbname = 'gestion_escolar';
$username = 'root';
$password = 'TU_PASSWORD_ROOT';

$dsn = "mysql:host=$host;port=3306;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    exit('No se pudo conectar con la base de datos.');
}
```

Para un entorno de uso real, es preferible crear un usuario específico para la aplicación con permisos limitados, en lugar de utilizar `root`.

## Ejecución con Docker Compose

1. Verifica que Docker y Docker Compose estén instalados.
2. Configura en el archivo `docker-compose.yml` el nombre de la base de datos como `gestion_escolar` y las credenciales que utilizarás.
3. Confirma que el servicio web tenga acceso al servicio de base de datos `db` en la red de Docker Compose.
4. Inicia los servicios desde la carpeta del proyecto:

   ```bash
   docker compose up -d
   ```

5. Accede a la aplicación web:

   ```text
   http://localhost:8089
   ```

6. Accede a phpMyAdmin:

   ```text
   http://localhost:8085
   ```

### Puertos del entorno

| Servicio | Puerto del contenedor | Puerto publicado |
|---|---:|---:|
| MySQL | 3306 | 3316 |
| Apache/PHP | 80 | 8089 |
| phpMyAdmin | 80 | 8085 |

Desde otros contenedores del mismo Compose, MySQL se alcanza usando `db:3306`. El puerto `3316` se utiliza para conexiones desde el host u otros equipos que accedan al puerto publicado.

## Consultas SQL realizadas

### Matrículas de estudiantes

Consulta estudiantes, materias, periodo y fecha de matrícula relacionando las tablas `matricula`, `estudiante` y `materia`.

### Evaluaciones y calificaciones

Consulta estudiantes, materias, tipo de evaluación, calificación y fecha, relacionando `evaluacion`, `matricula`, `estudiante` y `materia`. Los resultados se pueden ordenar por apellido.

### Actualización de una calificación

Se utiliza una instrucción `UPDATE` con una condición `WHERE` para modificar la calificación de una evaluación específica. Después, una consulta `SELECT` permite verificar el cambio.

## Uso del formulario

1. Abre la aplicación en el navegador.
2. Ingresa nombre y apellido del estudiante.
3. Captura, si corresponde, la fecha de nacimiento y el correo electrónico.
4. Envía el formulario para guardar el registro.
5. Consulta la lista de estudiantes para comprobar que el registro se almacenó correctamente.


