<?php

    session_start();
        
    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
        header('Location: ../app/login.php');
        exit();
    }

    require '../app/bd.php';

    //Consulta SQL para obtener las categorías
    $sql = mysqli_query($conexion, "SELECT * FROM categorias");
    $sql_subcategorias = mysqli_query($conexion, "SELECT * FROM subcategorias");

    //Consulta SQL para obtener las categorías papelería
    $sql_2 = mysqli_query($conexion, "SELECT * FROM categorias_papel");
    $sql_subcategorias_2 = mysqli_query($conexion, "SELECT * FROM subcategorias_papel");

    //Consulta SQL para obtener las categorías sticker
    $sql_3 = mysqli_query($conexion, "SELECT * FROM categorias_sticker");
    $sql_subcategorias_3 = mysqli_query($conexion, "SELECT * FROM subcategorias_sticker");
 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrar Categorías</title>
    <link rel="stylesheet" href="../estilos/estilo_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/9ab94acfdc.js" crossorigin="anonymous"></script>
    <style>
         /* Estilo para el contenedor que va a mostrar las dos tablas */
         .tabla-container {
            display: inline-block;
            width: 100%;
        }

        .titulo-tabla {
            width: content;
        }

        /* Estilo para las tablas */
        table {
            border-collapse: collapse;
            width: 35%;
            float: left;
            margin-right: 5%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div id="wrapper">
        <?php
            include('navbar_admin.php')
        ?>
        <div id="main">
            <div class="tabla-container">
                <h2 class="titulo-tabla">categorías 3D</h2>
                <?php
                //Mostramos las categorías en una tabla
                echo "<table>";
                echo "<td><a href='añadir_categoria.php' class='agregar-button'>Agregar Categoría</a></td>";
                echo "<tr>"; 
                echo "<th>ID Categoría</th>";
                echo "<th>Nombre Categoría</th>";
                echo "<th>Acciones</th>";
                echo "</tr>";
                while ($fila = mysqli_fetch_array($sql)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_categoria'] . "</td>";
                    echo "<td>" . $fila['nombre_categoria'] . "</td>";
                    echo "<td><a href='editar_categoria.php?id_categoria=" . $fila['id_categoria'] . "'>Editar</a> <a href='eliminar_categoria.php?id_categoria=" . $fila['id_categoria'] . "' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a></td>";
                    echo "</tr>";
                }
                echo "</table>";

                //Mostramos las subcategorías en una tabla
                echo "<h2>Subcategorías</h2>";
                echo "<table>";
                echo "<td><a href='añadir_subcategoria.php' class='agregar-button'>Agregar Subcategoría</a></td>";
                echo "<tr>";
                echo "<th>ID Subcategoría</th>";
                echo "<th>Nombre Subcategoría</th>";
                echo "<th>ID Categoría</th>";
                echo "</tr>";
                while ($fila = mysqli_fetch_array($sql_subcategorias)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_subcategoria'] . "</td>";
                    echo "<td>" . $fila['nombre_subcategoria'] . "</td>";
                    echo "<td>" . $fila['id_categoria'] . "</td>";
                    echo "<td><a href='editar_subcategoria.php?id_subcategoria=" . $fila['id_subcategoria'] . "'>Editar</a> <a href='eliminar_subcategoria.php?id_subcategoria=" . $fila['id_subcategoria'] . "' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>
            </div>

            <div class="tabla-container">
                <h2 class="titulo-tabla">categorías Sticker</h2>
                <?php
                //Mostramos las categorías en una tabla
                echo "<table>";
                echo "<td><a href='añadir_cat_sticker.php' class='agregar-button'>Agregar Categoría</a></td>";
                echo "<tr>"; 
                echo "<th>ID Categoría</th>";
                echo "<th>Nombre Categoría</th>";
                echo "<th>Acciones</th>";
                echo "</tr>";
                while ($fila = mysqli_fetch_array($sql_3)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_cat_sticker'] . "</td>";
                    echo "<td>" . $fila['nombre_cat_sticker'] . "</td>";
                    echo "<td><a href='editar_cat_sticker.php?id_categoria=" . $fila['id_cat_sticker'] . "'>Editar</a> <a href='eliminar_cat_sticker.php?id_categoria=" . $fila['id_cat_sticker'] . "' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a></td>";
                    echo "</tr>";
                }
                echo "</table>";

                //Mostramos las subcategorías en una tabla
                echo "<h2>Subcategorías</h2>";
                echo "<table>";
                echo "<td><a href='añadir_subcat_sticker.php' class='agregar-button'>Agregar Subcategoría</a></td>";
                echo "<tr>";
                echo "<th>ID Subcategoría</th>";
                echo "<th>Nombre Subcategoría</th>";
                echo "<th>ID Categoría</th>";
                echo "</tr>";
                while ($fila = mysqli_fetch_array($sql_subcategorias_3)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_subcat_sticker'] . "</td>";
                    echo "<td>" . $fila['nombre_subcat_sticker'] . "</td>";
                    echo "<td>" . $fila['id_cat_sticker'] . "</td>";
                    echo "<td><a href='editar_subcat_sticker.php?id_subcategoria=" . $fila['id_subcat_sticker'] . "'>Editar</a> <a href='eliminar_subcat_sticker.php?id_subcategoria=" . $fila['id_subcat_sticker'] . "' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
                ?>
            </div>

            <div class="tabla-container">
                <h2 class="titulo-tabla">categorías papelería</h2>
                <?php
                //Mostramos las categorías en una tabla
                echo "<table>";
                echo "<td><a href='añadir_cat_papel.php' class='agregar-button'>Agregar Categoría</a></td>";
                echo "<tr>"; 
                echo "<th>ID Categoría</th>";
                echo "<th>Nombre Categoría</th>";
                echo "<th>Acciones</th>";
                echo "</tr>";
                while ($fila = mysqli_fetch_array($sql_2)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_cat_papel'] . "</td>";
                    echo "<td>" . $fila['nombre_cat_papel'] . "</td>";
                    echo "<td><a href='editar_cat_papel.php?id_categoria=" . $fila['id_cat_papel'] . "'>Editar</a> <a href='eliminar_cat_papel.php?id_categoria=" . $fila['id_cat_papel'] . "' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a></td>";
                    echo "</tr>";
                }
                echo "</table>";

                //Mostramos las subcategorías en una tabla
                echo "<h2>Subcategorías</h2>";
                echo "<table>";
                echo "<td><a href='añadir_subcat_papel.php' class='agregar-button'>Agregar Subcategoría</a></td>";
                echo "<tr>";
                echo "<th>ID Subcategoría</th>";
                echo "<th>Nombre Subcategoría</th>";
                echo "<th>ID Categoría</th>";
                echo "</tr>";
                while ($fila = mysqli_fetch_array($sql_subcategorias_2)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_subcat_papel'] . "</td>";
                    echo "<td>" . $fila['nombre_subcat_papel'] . "</td>";
                    echo "<td>" . $fila['id_cat_papel'] . "</td>";
                    echo "<td><a href='editar_subcat_papel.php?id_subcategoria=" . $fila['id_subcat_papel'] . "'>Editar</a> <a href='eliminar_subcat_papel.php?id_subcategoria=" . $fila['id_subcat_papel'] . "' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a></td>";
                    echo "</tr>";
                }
                echo "</table>";

                mysqli_close($conexion); //Cerramos la conexión a la base de datos
                ?>
            </div>
        </div>
</div>
</body>
</html>