<?php
session_start();
require_once("db.php");

// Verificar si el usuario ha iniciado sesión y es administrador
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== 'admin') {
    echo "Acceso no autorizado";
    exit();
}

// Ruta donde se almacenarán los archivos
$uploadDirectory = "uploads/";

// Obtener el ID del usuario
$userId = $_POST["user_id"];

// Verificar el valor de $userId
echo "Valor de user_id: " . $userId;
var_dump($userId);

// Verificar si se ha enviado un archivo
if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
    // Obtener información del archivo
    $fileName = basename($_FILES["file"]["name"]);
    $filePath = $uploadDirectory . $fileName;

    // Obtener el nombre del examen desde el formulario
    $examName = $_POST["exam_name"];

    // Mover el archivo al directorio de subidas
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
        // Guardar la información del archivo en la base de datos
        $query = "INSERT INTO medical_exams (user_id, exam_name, exam_result, exam_file_path, file_path, exam_file_name) VALUES ('$userId', '$examName', 'Resultado del Examen', '$filePath', '$filePath', '$fileName')";
        $result = $conn->query($query);

        if ($result) {
            echo "Archivo subido exitosamente.";
        } else {
            echo "Error al guardar la información del archivo en la base de datos. Detalles: " . $conn->error;
        }
    } else {
        echo "Error al subir el archivo.";
    }
} else {
    echo "Error al procesar el archivo.";
}
?>



