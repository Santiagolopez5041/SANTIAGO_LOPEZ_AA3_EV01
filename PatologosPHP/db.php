<?php
$servername = "localhost";
$username = "root";
$password = "P@stelero5041";
$dbname = "patologos_db";
// Crear conxión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}
?>