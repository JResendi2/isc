<!--Este archivo actualiza los datos, enviados desde el archivo "3_modificar.php" -->
<?php
	session_start();//Se inicia una sesion
	if(!isset($_SESSION['user'])){// Verifica si existe la variable 'user' en el servidor
		//Si no existe entonce regresa al login
		header("location:../1_login/login.html");
		exit;
	}

	$id = $_SESSION['id']; /* Recupera el "usuario" que inicio sesion.
								  'user' es una variable almacenada en el servidor. */
?>
<?php 
	session_start();//Se inicia una sesion
	if(!isset($_SESSION['user'])){// Verifica si existe la variable 'user' en el servidor
		//Si no existe entonce regresa al login
		header("location:../1_login/login.html");
		exit;
	}

	include("conexion.php");

	// Recupera los datos del formulario
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$usuario = $_POST['usuario'];
	$contraseña = $_POST['contraseña'];
	$numtelefono = $_POST['numtelefono'];

	

	// Actualiza los datos
	$update = ("update usuarios set nombre='$nombre', usuario='$usuario', contraseña='$contraseña', numtelefono='$numtelefono' where id='$id'");
	mysqli_query($conexion,$update);
	// Regresa al archivo "1_tabla.php"
	header("location:inicio_de_docentes.php");


?>