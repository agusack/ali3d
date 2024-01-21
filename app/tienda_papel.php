<?php

session_start();

require('bd.php');
require('funciones.php');

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Papelería - ALI3D</title>
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

        // Obtener el valor de is_3d, si se especifica en la URL
        $is_3d = isset($_GET['is_3d']) ? $_GET['is_3d'] : '';

        $query_categorias = "SELECT id_cat_papel, nombre_cat_papel FROM categorias_papel";
        $result_categorias = mysqli_query($conexion, $query_categorias);

        while ($categoria = mysqli_fetch_assoc($result_categorias)) {
            $enlace_categoria = "tienda_papel.php?categoria=" . $categoria['id_cat_papel'];
            // Mantener el parámetro is_3d
            $enlace_categoria .= ($is_3d !== '') ? "&is_3d=$is_3d" : '';
            echo '<a href="' . $enlace_categoria . '" class="list-group-item" id="main-category">' . $categoria['nombre_cat_papel'] . '</a>';

            $query_subcategorias = "SELECT id_subcat_papel, nombre_subcat_papel FROM subcategorias_papel WHERE id_cat_papel=" . $categoria['id_cat_papel'];
            $result_subcategorias = mysqli_query($conexion, $query_subcategorias);

            while ($subcategoria = mysqli_fetch_assoc($result_subcategorias)) {
                $enlace_subcategoria = "tienda_papel.php?categoria=" . $categoria['id_cat_papel'] . '&subcategoria=' . $subcategoria['id_subcat_papel'];
                // Mantener el parámetro is_3d
                $enlace_subcategoria .= ($is_3d !== '') ? "&is_3d=$is_3d" : '';
                echo '<a href="' . $enlace_subcategoria . '" class="list-group-item" id="sub-category">' . $subcategoria['nombre_subcat_papel'] . '</a>';
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
      // Obtener el valor de is_3d, si se especifica en la URL
      $is_3d = isset($_GET['is_3d']) ? $_GET['is_3d'] : '';

      // Página actual
      if (isset($_GET['pagina'])) {
          $pagina_actual = intval($_GET['pagina']);
      } else {
          $pagina_actual = 1; // Página por defecto si no se especifica
      }

      // Calcula el número total de páginas
      $query_total = "SELECT COUNT(*) as total FROM productos";
      $resultado_total = mysqli_query($conexion, $query_total);
      $fila_total = mysqli_fetch_assoc($resultado_total);
      $total_productos = $fila_total['total'];
      $total_paginas = ceil($total_productos / $productos_por_pagina);

      // Construir el enlace para la página anterior
      $pagina_anterior = $pagina_actual - 1;
      $enlace_anterior = ($pagina_anterior > 1) ? "tienda_papel.php?pagina=$pagina_anterior&is_3d=$is_3d" : "tienda_papel.php?pagina=1&is_3d=$is_3d";
      echo "<a href='$enlace_anterior'>Anterior</a>";

      // Construir los enlaces para las páginas intermedias
      for ($i = 1; $i <= $total_paginas; $i++) {
          $enlace_pagina = "tienda_papel.php?pagina=$i&is_3d=$is_3d";
          if ($i == $pagina_actual) {
              echo "<span class='current'>$i</span>";
          } else {
              echo "<a href='$enlace_pagina'>$i</a>";
          }
      }

      // Construir el enlace para la página siguiente
      $pagina_siguiente = $pagina_actual + 1;
      $enlace_siguiente = ($pagina_siguiente <= $total_paginas) ? "tienda_papel.php?pagina=$pagina_siguiente&is_3d=$is_3d" : "tienda_papel.php?pagina=$total_paginas&is_3d=$is_3d";
      echo "<a href='$enlace_siguiente'>Siguiente</a>";
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

    function actualizarFiltro3D(valor) {
            // Obtener el estado actual de los checkboxes
            var checkbox_1 = document.getElementById('is_3d_1');
            var checkbox_0 = document.getElementById('is_3d_2');

            // Determinar si ambos checkboxes están marcados o ninguno está marcado
            var ambosClickeados = checkbox_1.checked && checkbox_0.checked;
            var ningunoClickeado = !checkbox_1.checked && !checkbox_0.checked;

            // Obtener la URL actual
            var urlActual = new URL(window.location.href);

            // Eliminar el parámetro is_3d de la URL si ambos están clickeados o ninguno está clickeado
            if (ambosClickeados || ningunoClickeado) {
                if (urlActual.searchParams.has('is_3d')) {
                    urlActual.searchParams.delete('is_3d');
                }
            } else {
                // Actualizar el parámetro is_3d en la URL según el checkbox clickeado
                urlActual.searchParams.set('is_3d', valor);
            }

            // Redirigir a la URL actualizada
            window.location.href = urlActual.toString();
        }
  </script>
</html>
<?php
// Cerrar la conexión
mysqli_close($conexion);
?>