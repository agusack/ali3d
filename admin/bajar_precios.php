<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../app/login.php');
    exit();
}

require('../app/conexion.php');

// Variables para mensajes de éxito o error
$exito = null;
$error = null;

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $producto_id = isset($_POST['producto']) ? $_POST['producto'] : null;
    $precio_anterior = isset($_POST['precio_anterior']) ? floatval($_POST['precio_anterior']) : null;
    $precio_nuevo = isset($_POST['precio_nuevo']) ? floatval($_POST['precio_nuevo']) : null;

    // Validar que los datos requeridos estén presentes
    if ($producto_id === null || $precio_anterior === null || $precio_nuevo === null) {
        $error = "Por favor, complete todos los campos.";
    } else {

        // Actualizar el precio y precio anterior
        $sql_actualizar = "UPDATE productos SET precio = :precio_nuevo, precio_ant = :precio_anterior WHERE id = :producto_id";
        $stmt_actualizar = $conexion->prepare($sql_actualizar);
        $stmt_actualizar->bindParam(':producto_id', $producto_id);
        $stmt_actualizar->bindParam(':precio_nuevo', $precio_nuevo);
        $stmt_actualizar->bindParam(':precio_anterior', $precio_anterior);

        if ($stmt_actualizar->execute()) {
            $exito = "Precio actualizado con éxito.";
        } else {
            $error = "Error al actualizar el precio. Por favor, inténtelo de nuevo.";
        }
    }
}

// Obtener la lista de productos desde la base de datos
$sql_productos = "SELECT id, nombre FROM productos";
$stmt_productos = $conexion->prepare($sql_productos);
$stmt_productos->execute();
$productos = $stmt_productos->fetchAll(PDO::FETCH_ASSOC);
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
            <h1 class="title">Bajar Precio</h1>

            <?php if ($exito) : ?>
                <div class="notification is-success"><?php echo $exito; ?></div>
            <?php endif; ?>

            <?php if ($error) : ?>
                <div class="notification is-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form action="bajar_precios.php" method="post">
                <div class="field">
                    <label class="label">Seleccione el Producto:</label>
                    <div class="control">
                        <!-- Aquí debería ir el menú desplegable con los productos -->
                        <select name="producto" class="select">
                            <!-- Iterar sobre la lista de productos y crear las opciones -->
                            <?php foreach ($productos as $producto) { ?>
                                <option value="<?php echo $producto['id']; ?>"><?php echo $producto['nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Precio Anterior:</label>
                    <div class="control">
                        <input type="number" step="0.01" name="precio_anterior" class="input" required>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Precio Nuevo:</label>
                    <div class="control">
                        <input type="number" step="0.01" name="precio_nuevo" class="input" required>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-primary">Actualizar Precio</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

