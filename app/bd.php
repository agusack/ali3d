<?php

// Conectar a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'ali3d');

// Chequear la conexión
if (mysqli_connect_errno()) {
  echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
  exit();
}

?>