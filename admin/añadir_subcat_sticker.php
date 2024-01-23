<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../app/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_subcategoria = $_POST['nombre_subcategoria'];
    $id_categoria = $_POST['id_categoria'];

    require '../app/bd.php';
    $categorias = mysqli_query($conexion, "SELECT * FROM categorias_papel");

    // Comprobamos si la conexión es exitosa
    if (mysqli_connect_errno()) {
        echo "Fallo al conectar a la base de datos: " . mysqli_connect_error();
    }

    // Sentencia SQL para agregar la categoría
    $sql = "INSERT INTO subcategorias_sticker (nombre_subcat_sticker, id_cat_sticker) VALUES ('$nombre_subcategoria', '$id_categoria')";

    if (mysqli_query($conexion, $sql)) {
        mysqli_close($conexion);
        header('Location: categorias_admin.php');
        exit();
    } else {
        echo "Error al agregar la categoría: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Añadir subcategoria papelería</title>
    <link rel="stylesheet" href="../estilos/estilo_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/9ab94acfdc.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="wrapper">
        <?php
            include('navbar_admin.php');
            require '../app/bd.php'; // Incluimos el archivo de conexión

            // Realizamos la consulta a las categorías
            $categorias = mysqli_query($conexion, "SELECT * FROM categorias_sticker");
        ?>
        <div id="main">
    <!-- Formulario para agregar categorías -->
            <h2>Añadir Subcategoría papelería</h2>
            <form action="añadir_subcat_sticker.php" method="POST">
                <label for="nombre_categoria">Nombre de la subcategoría:</label>
                <input type="text" name="nombre_subcategoria" id="nombre_subcategoria">
                <label for="id_categoria">Categoría global:</label><br>
                <select name="id_categoria" id="categoria">
                    <!-- Iteramos a través de cada categoría y creamos una opción por cada una -->
                    <?php while($categoria = mysqli_fetch_array($categorias)) { ?>
                        <option value="<?php echo $categoria['id_cat_sticker']; ?>"><?php echo $categoria['nombre_cat_sticker']; ?></option>
                    <?php } ?>
                </select>
                <input type="submit" value="Agregar">
            </form>
        </div>
    </div>
</body>
</html>