<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../app/login.php');
    exit();
}

// Requiere tu archivo de conexión
require('../app/bd.php');

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el porcentaje de aumento desde el formulario
    $porcentaje_aumento = isset($_POST['porcentaje_aumento']) ? $_POST['porcentaje_aumento'] : 0;

    // Validar que el porcentaje sea un número válido
    if (!is_numeric($porcentaje_aumento)) {
        die("Porcentaje de aumento no válido");
    }

    // Calcular el factor de aumento (por ejemplo, 0.1 para un 10%)
    $factor_aumento = 1 + ($porcentaje_aumento / 100);

    // Actualizar todos los precios en la base de datos
    $sql = "UPDATE productos SET precio = precio * ?";
    $stmt = $conexion->prepare($sql);

    // Enlazar el parámetro y ejecutar la consulta
    $stmt->bind_param("d", $factor_aumento);
    $stmt->execute();

    // Verificar si se ejecutó correctamente
    if ($stmt->affected_rows > 0) {
        echo "Aumento aplicado correctamente.";
    } else {
        echo "No se aplicó ningún aumento.";
    }

    // Cerrar la conexión
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Subir precios - ALI3D</title>
    <link rel="stylesheet" href="../estilos/estilo_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/9ab94acfdc.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="wrapper">
        <?php
            include('navbar_admin.php')
        ?>
        <div id="main">
        <!-- formulario_descuento.php -->
        <form action="subir_precios.php" method="post">
            <label for="porcentaje_aumento">Porcentaje de aumento:</label>
            <input type="number" name="porcentaje_aumento" required>
            <input type="submit" value="Aplicar Aumento">
        </form>
        </div>
    </div>
</body>
</html>