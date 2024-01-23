<?php

  // Obtener la categoría actual, si se especifica en la URL
  $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';

  // Obtener la subcategoría actual, si se especifica en la URL
  $subcategoria = isset($_GET['subcategoria']) ? $_GET['subcategoria'] : '';

  // Obtener la cadena de búsqueda, si se especifica en el formulario
  $buscar = isset($_POST['buscar']) ? $_POST['buscar'] : '';

  // Query para obtener los productos de la base de datos
  if ($subcategoria && $buscar) {
    $query = "SELECT * FROM productos WHERE id_subcategoria = '$subcategoria' AND nombre LIKE '%$buscar%'";
  } else if ($categoria && !$subcategoria) {
    $query = "SELECT * FROM productos WHERE id_categoria = '$categoria'";
  } else if ($categoria && $subcategoria) {
    $query = "SELECT * FROM productos WHERE id_subcategoria = '$subcategoria'";
  } else if ($buscar) {
    $query = "SELECT * FROM productos WHERE nombre LIKE '%$buscar%'";
  } else {
    $query = "SELECT * FROM productos";
  } 

  // Número de productos por página
  $productos_por_pagina = 15;

  $resultado = mysqli_query($conexion, $query);

  function obtenerCategorias($conexion) {
    // Hacer una consulta a la base de datos para obtener todas las categorías
    $query = "SELECT * FROM categorias";
    $result = mysqli_query($conexion, $query);
  
    // Crear un array vacío para almacenar las categorías principales
    $categorias_principales = array();
  
    // Iterar sobre el resultado de la consulta
    while ($row = mysqli_fetch_assoc($result)) {
      // Crear un array que represente la categoría principal
      $categoria = array(
        'id' => $row['id_categoria'],
        'nombre' => $row['nombre_categoria'],
        'subcategorias' => array()
      );
  
      // Agregar la categoría principal al array de categorías principales
      $categorias_principales[$row['id_categoria']] = $categoria;
    }
  
    // Hacer una consulta a la base de datos para obtener todas las subcategorías
    $query = "SELECT * FROM subcategorias";
    $result = mysqli_query($conexion, $query);
  
    // Iterar sobre el resultado de la consulta
    while ($row = mysqli_fetch_assoc($result)) {
      // Si la subcategoría tiene una categoría superior, es una subcategoría de una categoría principal
      if ($row['id_categoria']) {
        $subcategoria = array(
          'id' => $row['id_subcategoria'],
          'nombre' => $row['nombre_subcategoria']
        );
  
        // Agregar la subcategoría a su categoría principal correspondiente
        $categorias_principales[$row['id_categoria']]['subcategorias'][] = $subcategoria;
      }
    }
  
    // Devolver el array de categorías principales
    return $categorias_principales;
  
    // Cerrar la conexión a la base de datos
    $conexion->close();
  }

  function obtenerCategoriasPapel($conexion) {
    // Hacer una consulta a la base de datos para obtener todas las categorías
    $query = "SELECT * FROM categorias_papel";
    $result = mysqli_query($conexion, $query);
  
    // Crear un array vacío para almacenar las categorías principales
    $categorias_principales = array();
  
    // Iterar sobre el resultado de la consulta
    while ($row = mysqli_fetch_assoc($result)) {
      // Crear un array que represente la categoría principal
      $categoria = array(
        'id' => $row['id_cat_papel'],
        'nombre' => $row['nombre_cat_papel'],
        'subcategorias' => array()
      );
  
      // Agregar la categoría principal al array de categorías principales
      $categorias_principales[$row['id_cat_papel']] = $categoria;
    }
  
    // Hacer una consulta a la base de datos para obtener todas las subcategorías
    $query = "SELECT * FROM subcategorias_papel";
    $result = mysqli_query($conexion, $query);
  
    // Iterar sobre el resultado de la consulta
    while ($row = mysqli_fetch_assoc($result)) {
      // Si la subcategoría tiene una categoría superior, es una subcategoría de una categoría principal
      if ($row['id_cat_papel']) {
        $subcategoria = array(
          'id' => $row['id_subcat_papel'],
          'nombre' => $row['nombre_subcat_papel']
        );
  
        // Agregar la subcategoría a su categoría principal correspondiente
        $categorias_principales[$row['id_cat_papel']]['subcategorias'][] = $subcategoria;
      }
    }
  
    // Devolver el array de categorías principales
    return $categorias_principales;
  
    // Cerrar la conexión a la base de datos
    $conexion->close();
  }

  function obtenerCategoriasSticker($conexion) {
    // Hacer una consulta a la base de datos para obtener todas las categorías
    $query = "SELECT * FROM categorias_sticker";
    $result = mysqli_query($conexion, $query);
  
    // Crear un array vacío para almacenar las categorías principales
    $categorias_principales = array();
  
    // Iterar sobre el resultado de la consulta
    while ($row = mysqli_fetch_assoc($result)) {
      // Crear un array que represente la categoría principal
      $categoria = array(
        'id' => $row['id_cat_sticker'],
        'nombre' => $row['nombre_cat_sticker'],
        'subcategorias' => array()
      );
  
      // Agregar la categoría principal al array de categorías principales
      $categorias_principales[$row['id_cat_sticker']] = $categoria;
    }
  
    // Hacer una consulta a la base de datos para obtener todas las subcategorías
    $query = "SELECT * FROM subcategorias_sticker";
    $result = mysqli_query($conexion, $query);
  
    // Iterar sobre el resultado de la consulta
    while ($row = mysqli_fetch_assoc($result)) {
      // Si la subcategoría tiene una categoría superior, es una subcategoría de una categoría principal
      if ($row['id_cat_sticker']) {
        $subcategoria = array(
          'id' => $row['id_subcat_sticker'],
          'nombre' => $row['nombre_subcat_sticker']
        );
  
        // Agregar la subcategoría a su categoría principal correspondiente
        $categorias_principales[$row['id_cat_sticker']]['subcategorias'][] = $subcategoria;
      }
    }
  
    // Devolver el array de categorías principales
    return $categorias_principales;
  
    // Cerrar la conexión a la base de datos
    $conexion->close();
  }

?>
<div id="navbar">
<nav>
  <div id="conteiner_nav">
    <div id="logo"><img src="/ali3d/img/logos/ali3d.png" class="ajuste_img" alt="ALI3D Objetos 3D y stickers"></div>
      <div id="conteiner_buscador">
        <div class="buscador">
          <form action="/ali3d/app/tienda.php" method="post">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            <input type="text" id="buscar" name="buscar" placeholder="Buscar">
          </form>
        </div>
      </div>
    <div id="conteiner_user">
      <div id="carrito" class="button_nav"><a href="/ali3d/app/carrito.php"><i class="fas fa-shopping-cart" id="carrito-icono"></i> (<?php echo $cantidad_total; ?>)</a></div>
      <!-- HTML existente -->
      <div id="user" class="button_nav" style="position: relative;">
        <?php
          // Verificar si la sesión está iniciada
          if(isset($_SESSION['username'])) {
            // Mostrar mensaje personalizado con el nombre de usuario
            echo '<a href="#" class="username"><i class="fa-solid fa-user"></i></a>';
          } else {
            // Mostrar enlace "Iniciar sesión"
            echo '<a href="/ali3d/app/iniciar_sesion.php"><i class="fa-solid fa-user"></i></a>';
          }
        ?>
        <div id="menu-usuario" style="display: none; position: absolute; top: 100%; right: 0; width: 20rem;">
        <?php
          // Mostrar botón de panel de administración solo si el usuario es un administrador
          if(isset($_SESSION['is_admin']) && ($_SESSION['is_admin'] > 0)) {
            echo '<a href="/ali3d/admin/admin_panel.php">Panel de Administración</a>';
          }
        ?>
        <a href="/ali3d/app/cerrar_sesion.php">Cerrar sesión</a>
        </div>
        </div>
    </div>
  </div>
</nav>
<div id="subnav">
    <div>
      <a href="/ali3d/index.php" class="button_subnav">Inicio</a>
    </div>
    <div id="menuCategorias" class="menu">
      <a href="/ali3d/app/tienda.php?is_3d=1" class="button_subnav">Impresión 3D</a>
      <div class="menu-categorias" id="listaCategorias">
        <?php $categorias = obtenerCategorias($conexion); ?>
        <?php foreach ($categorias as $categoria) : ?>
          <div class="categoria-principal">
            <p>
              <a href="/ali3d/app/tienda.php?is_3d=1&categoria=<?php echo $categoria['id']; ?>">
                <?php echo $categoria['nombre']; ?>
              </a>
            </p>
            <ul class="subcategorias">
              <?php foreach ($categoria['subcategorias'] as $subcategoria) : ?>
                <li>
                  <a href="/ali3d/app/tienda.php?is_3d=1&categoria=<?php echo $categoria['id']; ?>&subcategoria=<?php echo $subcategoria['id']; ?>">
                    <?php echo $subcategoria['nombre']; ?>
                  </a>
                  <?php if (!empty($subcategoria['productos'])): ?>
                    <ul class="productos">
                      <?php foreach ($subcategoria['productos'] as $producto) : ?>
                        <li><?php echo $producto['nombre']; ?></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div id="menuCategorias2" class="menu">
      <a href="/ali3d/app/tienda_sticker.php?is_3d=2" class="button_subnav">Stickers</a>
      <div class="menu-categorias" id="listaCategorias2">
        <?php $categorias = obtenerCategoriasSticker($conexion); ?>
        <?php foreach ($categorias as $categoria) : ?>
          <div class="categoria-principal">
            <p>
              <a href="/ali3d/app/tienda_sticker.php?is_3d=2&categoria=<?php echo $categoria['id']; ?>">
                <?php echo $categoria['nombre']; ?>
              </a>
            </p>
            <ul class="subcategorias">
              <?php foreach ($categoria['subcategorias'] as $subcategoria) : ?>
                <li>
                  <a href="/ali3d/app/tienda_sticker.php?is_3d=2&categoria=<?php echo $categoria['id']; ?>&subcategoria=<?php echo $subcategoria['id']; ?>">
                    <?php echo $subcategoria['nombre']; ?>
                  </a>
                  <?php if (!empty($subcategoria['productos'])): ?>
                    <ul class="productos">
                      <?php foreach ($subcategoria['productos'] as $producto) : ?>
                        <li><?php echo $producto['nombre']; ?></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div id="menuCategorias3" class="menu">
      <a href="/ali3d/app/tienda_papel.php?is_3d=3" class="button_subnav">Papelería</a>
      <div class="menu-categorias" id="listaCategorias3">
        <?php $categorias = obtenerCategoriasPapel($conexion); ?>
        <?php foreach ($categorias as $categoria) : ?>
          <div class="categoria-principal">
            <p>
              <a href="/ali3d/app/tienda_papel.php?is_3d=3&categoria=<?php echo $categoria['id']; ?>">
                <?php echo $categoria['nombre']; ?>
              </a>
            </p>
            <ul class="subcategorias">
              <?php foreach ($categoria['subcategorias'] as $subcategoria) : ?>
                <li>
                  <a href="/ali3d/app/tienda_papel.php?is_3d=3&categoria=<?php echo $categoria['id']; ?>&subcategoria=<?php echo $subcategoria['id']; ?>">
                    <?php echo $subcategoria['nombre']; ?>
                  </a>
                  <?php if (!empty($subcategoria['productos'])): ?>
                    <ul class="productos">
                      <?php foreach ($subcategoria['productos'] as $producto) : ?>
                        <li><?php echo $producto['nombre']; ?></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div>
      <a href="https://wa.me/542964408658?text=Hola%20como%20estas%3F%0A" target="_blank" class="button_subnav">Contacto</a>
    </div>
</div>
</div>
<script>
  const menuCategorias = document.querySelector("#menuCategorias");
  const listaCategorias = document.querySelector("#listaCategorias");

  // muestra el menu de categorias al pasar el mouse por encima
  menuCategorias.addEventListener("mouseover", function() {
    listaCategorias.style.display = "flex";
  });

  // cierra el menu de categorias si el mouse se mueve fuera de él
  menuCategorias.addEventListener("mouseleave", function() {
    listaCategorias.style.display = "none";
  });

  // evita que el menu se cierre si el mouse esta dentro de el
  listaCategorias.addEventListener("mouseover", function() {
    listaCategorias.style.display = "flex";
  });

  // cierra el menu si el mouse da clic en cualquier parte dentro del documento
  document.addEventListener("click", function(e) {
    if (!menuCategorias.contains(e.target)) {
      listaCategorias.style.display = "none";
    }
  });

  // cierra el menu si el mouse se mueve fuera de la lista de categorias
  listaCategorias.addEventListener("mouseleave", function() {
    listaCategorias.style.display = "none";
  });

  const menuCategorias2 = document.querySelector("#menuCategorias2");
  const listaCategorias2 = document.querySelector("#listaCategorias2");

  // muestra el menu de categorias al pasar el mouse por encima
  menuCategorias2.addEventListener("mouseover", function() {
    listaCategorias2.style.display = "flex";
  });

  // cierra el menu de categorias si el mouse se mueve fuera de él
  menuCategorias2.addEventListener("mouseleave", function() {
    listaCategorias2.style.display = "none";
  });

  // evita que el menu se cierre si el mouse esta dentro de el
  listaCategorias2.addEventListener("mouseover", function() {
    listaCategorias2.style.display = "flex";
  });

  // cierra el menu si el mouse da clic en cualquier parte dentro del documento
  document.addEventListener("click", function(e) {
    if (!menuCategorias.contains(e.target)) {
      listaCategorias2.style.display = "none";
    }
  });

  // cierra el menu si el mouse se mueve fuera de la lista de categorias
  listaCategorias2.addEventListener("mouseleave", function() {
    listaCategorias2.style.display = "none";
  });

  const menuCategorias3 = document.querySelector("#menuCategorias3");
  const listaCategorias3 = document.querySelector("#listaCategorias3");

  // muestra el menu de categorias al pasar el mouse por encima
  menuCategorias3.addEventListener("mouseover", function() {
    listaCategorias3.style.display = "flex";
  });

  // cierra el menu de categorias si el mouse se mueve fuera de él
  menuCategorias3.addEventListener("mouseleave", function() {
    listaCategorias3.style.display = "none";
  });

  // evita que el menu se cierre si el mouse esta dentro de el
  listaCategorias3.addEventListener("mouseover", function() {
    listaCategorias3.style.display = "flex";
  });

  // cierra el menu si el mouse da clic en cualquier parte dentro del documento
  document.addEventListener("click", function(e) {
    if (!menuCategorias.contains(e.target)) {
      listaCategorias3.style.display = "none";
    }
  });

  // cierra el menu si el mouse se mueve fuera de la lista de categorias
  listaCategorias3.addEventListener("mouseleave", function() {
    listaCategorias3.style.display = "none";
  });

  // Obtener el elemento que contiene el nombre de usuario
  var usernameLink = document.querySelector('.username');

  // Obtener el cuadro de opciones
  var optionsBox = document.querySelector('#menu-usuario');

  // Mostrar el cuadro de opciones al pasar el mouse por encima del nombre de usuario
  usernameLink.addEventListener('mouseover', function() {
    optionsBox.style.display = 'block';
  });

  // Ocultar el cuadro de opciones al mover el mouse fuera del mismo
  optionsBox.addEventListener('mouseleave', function() {
    optionsBox.style.display = 'none';
  });

</script>