<?php
session_start();
require_once("db.php");

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION["user_id"];

// Obtener los resultados de los exámenes médicos del usuario
$query = "SELECT * FROM medical_exams WHERE user_id = $userId";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de Exámenes Médicos</title>
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

        .exam-box {
            border: 2px solid #409aa8; /* Borde de color azul claro */
            padding: 10px;
            margin-bottom: 15px;
            text-align: left;
        }

        p {
            font-size: 1.2em;
        }

        strong {
            color: #409aa8; /* Azul claro */
        }

        a {
            color: #409aa8; /* Azul claro */
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Resultados de Exámenes Médicos</h2>

    <?php
    // Mostrar los resultados de los exámenes médicos
    while ($row = $result->fetch_assoc()) {
        echo "<div class='exam-box'>";
        echo "<p><strong>{$row['exam_name']}:</strong></p>";
        echo "<a href='{$row['exam_file_path']}' download>Descargar Examen en PDF</a><br>";
        echo "</div>";
    }
    ?>

    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>

