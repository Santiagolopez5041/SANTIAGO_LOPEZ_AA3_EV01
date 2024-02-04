<?php
// Incluir archivo de conexión a la base de datos
require_once("db.php");

// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];  // No ciframos la contraseña aquí
    $email = $_POST["email"];

    // Utilizamos password_hash para cifrar la contraseña antes de almacenarla
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertar nuevo usuario en la base de datos
    $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
    $result = $conn->query($query);

    if ($result) {
        // Redirigir al usuario a la página de inicio de sesión después del registro exitoso
        header("Location: login.php");
        exit();
    } else {
        // Mostrar un mensaje de error si el registro falla
        $error = "Error al registrar el usuario. Por favor, inténtalo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
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
    <h2>Registro de Usuario</h2>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    <form method="post" action="">
        <label for="username">Usuario:</label>
        <input type="text" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br>
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required><br>
        <input type="submit" value="Registrarse">
    </form>
    <p>¿Ya tienes una cuenta? <a href="login.php">Inicia Sesión</a></p>
</body>
</html>

