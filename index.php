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
  <!-- Sección del slider con imágenes -->
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicadores del slider -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- Imágenes del slider -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="img/banner/hero.png" alt="Slide 1" class="slider-img">
      </div>
      <div class="item">
        <img src="img/banner/banner.png" alt="Slide 2" class="slider-img">
      </div>
      <div class="item">
        <img src="img/banner/banner.png" alt="Slide 3" class="slider-img">
      </div>
    </div>
    <!-- Controles del slider -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Anterior</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Siguiente</span>
    </a>
  </div>
  <section id="conteiner_index">
  <!-- Sección de productos 3D -->
  <div class="popular-products">
    <h2>Productos 3D</h2>
    <div class="productos-list">
      <?php
      $query = "SELECT * FROM `productos` WHERE `is_3d` = '1' LIMIT 6";
      $resultado = mysqli_query($conexion, $query);

      while ($producto = mysqli_fetch_array($resultado)) {
          echo "<div class='card'><a href='app/producto.php?id=" . $producto['id'] . "'>";
          echo "<div class='card-img'><img class='card-img' src='" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "'></div>";
          echo "<div class='card-info'>";
          echo "<p class='text-title'>" . $producto['nombre'] . "</p>";
          echo "</div>";
          echo "<div class='card-footer'>";
      
          // Verificar si hay un precio anterior
          if ($producto['precio_ant'] > 0) {
              // Mostrar precio anterior tachado
              echo "<span class='text-title old-price'>$" . $producto['precio_ant'] . "</span>";
              echo "<div id='descuento'><i class='fa-solid fa-percent fa-shake'></i></div>";
          }
      
          // Mostrar precio actual
          echo "<span class='text-title current-price'>$" . $producto['precio'] . "</span></a>";
          echo "<a href='app/producto.php?id=" . $producto['id'] . "'><div class='card-button'> Ver más";
          echo "</div></a>";
          echo "</div></div>";
      }
      ?>
    </div>
  </div>

  <div id="secciones" class="parent">
        <div id="seccion_3d" class="div1">
          <a href="app/tienda.php?is_3d=1">
            <div><p>Visita nuestra sección <br>Impresión 3D</p></div>
          </a>
        </div>
        <div id="seccion_sticker" class="div2">
          <a href="app/tienda.php?is_3d=2">
            <div><p>Visita nuestra sección <br>Stickers</p></div>
          </a>
        </div>
        <div id="seccion_contacto" class="div3">
          <a href="https://wa.me/542964408658?text=Hola%20como%20estas%3F%0A" target="_blank">
            <div><p>¿Tenés una idea? contactate con nosotros</p></div>
          </a>
        </div>
  </div>

  <!-- Sección de Stickers -->
  <div class="new-products">
    <h2>Stickers</h2>
    <div class="productos-list">
      <?php
      $query = "SELECT * FROM `productos` WHERE `is_3d` = '2' LIMIT 6";
      $resultado = mysqli_query($conexion, $query);

      while ($producto = mysqli_fetch_array($resultado)) {
        echo "<div class='card'><a href='app/producto.php?id=" . $producto['id'] . "'>";
        echo "<div class='card-img'><img class='card-img' src='" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "'></div>";
        echo "<div class='card-info'>";
        echo "<p class='text-title'>" . $producto['nombre'] . "</p>";
        echo "</div>";
        echo "<div class='card-footer'>";
    
        // Verificar si hay un precio anterior
        if ($producto['precio_ant'] > 0) {
            // Mostrar precio anterior tachado
            echo "<span class='text-title old-price'>$" . $producto['precio_ant'] . "</span>";
            echo "<div id='descuento'><i class='fa-solid fa-percent fa-shake'></i></div>";
        }
    
        // Mostrar precio actual
        echo "<span class='text-title current-price'>$" . $producto['precio'] . "</span></a>";
        echo "<a href='app/producto.php?id=" . $producto['id'] . "'><div class='card-button'> Ver más";
        echo "</div></a>";
        echo "</div></div>";
      }
      ?>
    </div>
  </div>
  <div id="papeleria">
      <div>
        <a href="app/tienda_papel.php?is_3d=3">
          <div><p>Visita nuestra sección papelería</p></div>
        </a>
      </div>
  </div>
  <div class="papel-products">
    <h2>Papelería</h2>
    <div class="productos-list">
      <?php
      $query = "SELECT * FROM `productos` WHERE `is_3d` = '3' LIMIT 6";
      $resultado = mysqli_query($conexion, $query);

      while ($producto = mysqli_fetch_array($resultado)) {
        echo "<div class='card'><a href='app/producto.php?id=" . $producto['id'] . "'>";
        echo "<div class='card-img'><img class='card-img' src='" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "'></div>";
        echo "<div class='card-info'>";
        echo "<p class='text-title'>" . $producto['nombre'] . "</p>";
        echo "</div>";
        echo "<div class='card-footer'>";
    
        // Verificar si hay un precio anterior
        if ($producto['precio_ant'] > 0) {
            // Mostrar precio anterior tachado
            echo "<span class='text-title old-price'>$" . $producto['precio_ant'] . "</span>";
            echo "<div id='descuento'><i class='fa-solid fa-percent fa-shake'></i></div>";
        }
    
        // Mostrar precio actual
        echo "<span class='text-title current-price'>$" . $producto['precio'] . "</span></a>";
        echo "<a href='app/producto.php?id=" . $producto['id'] . "'><div class='card-button'> Ver más";
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