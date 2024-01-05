<?php

    session_start();

    require('app/bd.php');
    require('app/funciones.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>ALI3D</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/9ab94acfdc.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="estilos/estilo_productos_card.css">
  <link rel="stylesheet" href="estilos/estilo_navbar.css">
  <link rel="stylesheet" href="estilos/estilo_index.css">
  <link rel="stylesheet" href="estilos/estilo_footer.css">
</head>
<body>
  <?php
    include('app/navbar.php');
  ?>
  <section id="page">
  <div id="hero">
    <h1>Impresión 3D <br> y Stickers <br> a tu Estilo</h1>
  </div>
  <section id="conteiner_index">
  <!-- Sección de productos 3D -->
  <div class="popular-products">
    <h2>Productos 3D</h2>
    <div class="productos-list">
      <?php
      $query = "SELECT * FROM `productos` WHERE `is_3d` = 1 LIMIT 6";
      $resultado = mysqli_query($conexion, $query);

        while ($producto = mysqli_fetch_array($resultado)) {
          echo "<div class='card'><a href='app/producto.php?id=". $producto['id'] . "'>";
          echo "<div class='card-img'><img class='card-img' src='" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "'></div>";
          echo "<div class='card-info'>";
          echo "<p class='text-title'>" . $producto['nombre'] . "</p>";
          echo "</div>";
          echo "<div class='card-footer'>";
          echo "<span class='text-title'> $" . $producto['precio'] . "</span></a>";
          echo "<a href='app/producto.php?id=". $producto['id'] . "'><div class='card-button'> Ver más";
          echo "</div></a>";
          echo "</div></div>";
        }
      ?>
    </div>
  </div>

  <div id="secciones" class="parent">
        <div id="seccion_3d" class="div1">
          <a href="app/tienda.php?is_3d=1">
            <div><p>Visita nuestra sección <br>3D</p></div>
          </a>
        </div>
        <div id="seccion_sticker" class="div2">
          <a href="app/tienda.php?is_3d=0">
            <div><p>Visita nuestra sección <br>Stickers</p></div>
          </a>
        </div>
        <div id="seccion_contacto" class="div3">
          <a href="">
            <div><p>¿Tenés una idea? contactate con nosotros</p></div>
          </a>
        </div>
  </div>

  <!-- Sección de Stickers -->
  <div class="new-products">
    <h2>Stickers</h2>
    <div class="productos-list">
      <?php
      $query2 = "SELECT * FROM `productos` WHERE 'is_3d' = 0 LIMIT 6";
      $resultado2 = mysqli_query($conexion, $query2);

      while ($producto2 = mysqli_fetch_array($resultado2)) {
        echo "<div class='card'><a href='app/producto.php?id=". $producto2['id'] . "'>";
        echo "<div class='card-img'><img class='card-img' src='" . $producto2['imagen'] . "' alt='" . $producto2['nombre'] . "'></div>";
        echo "<div class='card-info'>";
        echo "<p class='text-title'>" . $producto2['nombre'] . "</p>";
        echo "</div>";
        echo "<div class='card-footer'>";
        echo "<span class='text-title'> $" . $producto2['precio'] . "</span></a>";
        echo "<a href='app/producto.php?id=". $producto2['id'] . "'><div class='card-button'> Ver más";
        echo "</div></a>";
        echo "</div></div>";
      }

      mysqli_close($conexion);
      ?>
    </div>
  </div>
  </section>
  <?php
    include('app/footer.php');
  ?>
  </section>
</body>
</html>