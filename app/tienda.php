<?php

session_start();

require('bd.php');
require('funciones.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tienda online</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/9ab94acfdc.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../estilos/estilo_navbar.css">
  <link rel="stylesheet" href="../estilos/estilo_tienda.css">
  <link rel="stylesheet" href="../estilos/estilo_productos_card.css">
</head>
<body>
  <?php
    include('navbar.php');
  ?>
  <section id="page">
  <button id="toggle-menu">☰</button>
    <div id="menu" class="col-md-2">
    <div class="list-group">
      <h4>CATEGORÍAS</h4>
      <?php
        $query = "SELECT id_categoria, nombre_categoria FROM categorias";
        $result = mysqli_query($conexion, $query);
        while ($categoria = mysqli_fetch_assoc($result)) {
          echo '<a href="?categoria=' . $categoria['id_categoria'] . '" class="list-group-item" id="main-category">' . $categoria['nombre_categoria'] . '</a>';
          $query = "SELECT id_subcategoria, nombre_subcategoria FROM subcategorias WHERE id_categoria=" . $categoria['id_categoria'];
          $subcategorias = mysqli_query($conexion, $query);
          while ($subcategoria = mysqli_fetch_assoc($subcategorias)) {
            echo '<a href="?categoria=' . $categoria['id_categoria'] . '&subcategoria=' . $subcategoria['id_subcategoria'] . '" class="list-group-item" id="sub-category">' . $subcategoria['nombre_subcategoria'] . '</a>';
          }
        }
      ?>
    </div>
  </div>
  <section id="seccion-productos">
    <div class="productos">
      <ul class="productos-list">
          <?php
            // Obtener el valor de is_3d, si se especifica en la URL
            $is_3d = isset($_GET['is_3d']) ? $_GET['is_3d'] : '';

            // Almacenar los resultados en un array
            $productosArray = [];
            while ($producto = mysqli_fetch_array($resultado)) {
                $productosArray[] = $producto;
            }

            // Filtrar el array $productosArray solo si se especifica un valor para is_3d
            if ($is_3d !== '') {
                $productosFiltrados = array_filter($productosArray, function($producto) use ($is_3d) {
                    // Comparar el valor de is_3d del producto con el valor proporcionado por el usuario
                    return $producto['is_3d'] == $is_3d;
                });
            } else {
                $productosFiltrados = $productosArray;
            }

            // Número de productos por página
            $productos_por_pagina = 15;

            // Página actual
            if (isset($_GET['pagina'])) {
                $pagina_actual = intval($_GET['pagina']);
            } else {
                $pagina_actual = 1; // Página por defecto si no se especifica
            }

            // Calcula el offset y el límite para la paginación
            $offset = ($pagina_actual - 1) * $productos_por_pagina;
            $productosMostrar = array_slice($productosFiltrados, $offset, $productos_por_pagina);

            // Imprimir los resultados
            foreach ($productosMostrar as $producto) {
                echo "<div class='card'><a href='../app/producto.php?id=". $producto['id'] . "'>";
                echo "<div class='card-img'><img class='card-img' src='" . $producto['imagen'] . "' alt='" . $producto['nombre'] . "'></div>";
                echo "<div class='card-info'>";
                echo "<p class='text-title'>" . $producto['nombre'] . "</p>";
                echo "</div>";
                echo "<div class='card-footer'>";
                echo "<span class='text-title'> $" . $producto['precio'] . "</span></a>";
                echo "<a href='../app/producto.php?id=". $producto['id'] . "'><div class='card-button'> Ver más";
                echo "</div></a>";
                echo "</div></div>";
            }
          ?>
      </ul>
    </div>
  </section>
  <div class="pagination">
    <?php
    // Calcula el número total de páginas
    $query_total = "SELECT COUNT(*) as total FROM productos";
    $resultado_total = mysqli_query($conexion, $query_total);
    $fila_total = mysqli_fetch_assoc($resultado_total);
    $total_productos = $fila_total['total'];
    $total_paginas = ceil($total_productos / $productos_por_pagina);

    $pagina_anterior = $pagina_actual - 1;
    $pagina_siguiente = $pagina_actual + 1;

    if ($pagina_actual > 1) {
        echo "<a href='tienda.php?pagina=$pagina_anterior'>Anterior</a>";
    }
    if ($total_paginas > 1) {
        for ($i = 1; $i <= $total_paginas; $i++) {
            if ($i == $pagina_actual) {
                echo "<span class='current'>$i</span>";
            } else {
                echo "<a href='tienda.php?pagina=$i'>$i</a>";
            }
        }
    }
    if ($pagina_actual < $total_paginas) {
        echo "<a href='tienda.php?pagina=$pagina_siguiente'>Siguiente</a>";
    }
    ?>
</div>
  </section>
  </body>
  <script>
    const toggleMenu = document.getElementById('toggle-menu');
    const menu = document.getElementById('menu');

    toggleMenu.addEventListener('click', () => {
      menu.classList.toggle('visible');
    });
  </script>
</html>
<?php
// Cerrar la conexión
mysqli_close($conexion);
?>