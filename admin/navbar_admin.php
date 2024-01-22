<button id="toggle-menu">☰</button>
<div class="sidebar" id="menu">
    <div class="logo"><img src="../img/logos/ali3d.png" alt="ALI3D"></div>
    <div>
        <a href="admin_panel.php"><i class="fa-solid fa-house"></i> Inicio</a>
        <a href="pedidos_admin.php"><i class="fa-solid fa-code-pull-request"></i> Pedidos</a>
        <a href="productos_admin.php"><i class="fa-solid fa-star"></i> Productos</a>
        <a href="categorias_admin.php"><i class="fa-solid fa-tag"></i> Categorías</a>
        <a href="usuarios_admin.php"><i class="fa-solid fa-user"></i> Usuarios</a>
        <a href="ventas_admin.php"><i class="fa-solid fa-sack-dollar"></i> Ventas</a>
        <a href="herramientas_admin.php"><i class="fa-solid fa-screwdriver-wrench"></i> Herramientas</a>
    </div>
        <a href="../app/tienda.php"><i class="fa-solid fa-cart-shopping"></i> Volver a la tienda</a>
</div>
<script>
    const toggleMenu = document.getElementById('toggle-menu');
    const menu = document.getElementById('menu');

    toggleMenu.addEventListener('click', () => {
      menu.classList.toggle('visible');
    });
  </script>