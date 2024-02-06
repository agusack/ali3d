<?php
// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre del nuevo tag del cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"));

    // Verificar si se recibió correctamente el nombre del nuevo tag
    if (isset($data->nombre) && !empty($data->nombre)) {
        // Conectar a la base de datos (debes incluir tu archivo de conexión aquí)
        include_once "../app/conexion.php"; // Suponiendo que tu archivo de conexión se llama "conexion.php"

        try {
            // Preparar la consulta SQL para insertar el nuevo tag
            $sql = "INSERT INTO tags (nombre_tag) VALUES (:nombre)";
            $stmt = $conexion->prepare($sql);
            
            // Ejecutar la consulta SQL
            $stmt->execute([':nombre' => $data->nombre]);

            // Obtener el ID del nuevo tag insertado
            $nuevoTagId = $conexion->lastInsertId();

            // Devolver el ID del nuevo tag como respuesta
            echo json_encode(array("id" => $nuevoTagId));
        } catch (PDOException $e) {
            // Manejar cualquier error de la base de datos
            echo json_encode(array("error" => "Error al agregar el nuevo tag: " . $e->getMessage()));
        }
    } else {
        // Devolver un mensaje de error si el nombre del tag está vacío o no está presente en la solicitud
        echo json_encode(array("error" => "El nombre del tag es obligatorio"));
    }
} else {
    // Devolver un mensaje de error si no se recibió una solicitud POST
    echo json_encode(array("error" => "Se esperaba una solicitud POST"));
}
?>
