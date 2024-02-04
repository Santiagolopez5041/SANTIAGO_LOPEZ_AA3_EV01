<?php
session_start();
require_once("db.php");

// Verificar si se envió el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consultar la base de datos para verificar las credenciales
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verificar la contraseña utilizando password_verify
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["role"] = $user["role"];

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos";
        }
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
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

        p {
            font-size: 1.2em;
            color: red;
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
            margin-bottom: 10px;
            width: 25%;
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
    </style>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
    <form method="post" action="">
        <label for="username">Usuario:</label>
        <input type="text" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>

