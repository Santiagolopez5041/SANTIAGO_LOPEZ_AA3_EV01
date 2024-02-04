<?php
session_start();
require_once("db.php");

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION["role"];

// Verificar si el usuario es administrador
if ($role === 'admin') {
    // Página del panel de control para el administrador
    // Puedes agregar aquí la funcionalidad para subir exámenes médicos si es necesario
} elseif ($role === 'user') {
    // Redirigir al usuario a la página de resultados de exámenes médicos
    header("Location: exam_results.php");
    exit();
} else {
    echo "Acceso no autorizado";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <style>
        body {
            background-color: #f1f0ee; /* Blanco */
            color: #409aa8; /* Azul claro */
            text-align: center;
            margin-top: 10%;
        }

        h2 {
            font-size: 2em;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 1.2em;
        }

        input {
            padding: 8px;
            font-size: 1em;
            margin-bottom: 50px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #409aa8; /* Azul claro */
            color: #f1f0ee; /* Blanco */
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #f1f0ee; /* Blanco */
            color: #409aa8; /* Azul claro */
        }

        p {
            font-size: 1.2em;
            color: red;
        }

        h3 {
            color: #409aa8; /* Azul claro */
        }

        a {
            color: #409aa8; /* Azul claro */
        }
    </style>
</head>
<body>
    <h2>Panel de Administración</h2>

    <!-- Formulario para subir archivos -->
    <form action="upload_file.php" method="post" enctype="multipart/form-data">
        <label for="exam_name">Nombre del Examen:</label>
        <input type="text" name="exam_name" required><br>
        <label for="file">Seleccionar archivo:</label>
        <input type="file" name="file" id="file" required>

        <!-- Lista desplegable de usuarios -->
        <label for="user_id">Seleccionar usuario:</label>
        <select name="user_id" id="user_id" required>
            <?php
            // Obtener la lista de usuarios
            $query = "SELECT id, username FROM users";
            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['username']}</option>";
            }
            ?>
        </select>

        <input type="submit" value="Subir Archivo">
    </form>

    <!-- Mostrar resultados de exámenes médicos -->
    <h3>Resultados de Exámenes Médicos</h3>
    <?php
    // Obtener los resultados de exámenes médicos para el usuario seleccionado
    $selectedUserId = $_SESSION["user_id"];
    $query = "SELECT exam_name FROM medical_exams WHERE user_id = '$selectedUserId'";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        echo "<p>Nombre del Examen: {$row['exam_name']}</p>";
        echo "<a href='path_to_download_script.php?exam_name={$row['exam_name']}' target='_blank'>Descargar Examen en PDF</a>";
        echo "<hr>";
    }
    ?>

    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>





