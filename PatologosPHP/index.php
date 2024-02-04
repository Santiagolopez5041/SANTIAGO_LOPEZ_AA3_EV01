<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página de Inicio</title>
    <style>
        body {
            background-color: #f1f0ee;
            color: #409aa8;
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100vh; /* Esto establece la altura del contenedor principal al 100% de la altura de la ventana */
        }

        h1 {
            color: #409aa8;
        }

        p {
            margin-bottom: 20px;
        }

        a {
            color: #409aa8;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Bienvenido a Patologos del Cauca</h1>
    <p>Por favor, inicia sesión para acceder al sistema.</p>
    <a href="login.php">Iniciar Sesión</a>
    <p>¿No tienes una cuenta? <a href="registro.php">Regístrate</a></p>
</body>
</html>


