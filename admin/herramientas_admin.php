<?php

    session_start();
        
    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
        header('Location: ../app/login.php');
        exit();
    }

    require('../app/bd.php');




      // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
  ?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel de admin</title>
    <link rel="stylesheet" href="../estilos/estilo_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/9ab94acfdc.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="wrapper">
            <?php
                include('navbar_admin.php')
            ?>
        <div class="container">
            <h2>Herramientas</h2>
            <div id="conteiner_tool">
                <div class="tool_btn">
                    <a href="subir_precios.php">
                        <div><p><i class="fa-solid fa-plus"></i> Subir precios</p></div>
                    </a>
                </div>
                <div class="tool_btn">
                    <a href="bajar_precios.php">
                        <div><p><i class="fa-solid fa-minus"></i> Descuento</p></div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>