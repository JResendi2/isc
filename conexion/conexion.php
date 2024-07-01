<?php
// Este archivo se utiliza para hacer la conexion con la base de datos "isc".

/*                       'servidor'  'usuario'  'contraseña'  'BD'           */

$conexion = mysqli_connect('localhost', 'root', 'rootroot', 'isc') or die(mysqli_error($mysqli));
?>