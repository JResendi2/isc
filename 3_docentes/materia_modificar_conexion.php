<!--Este archivo actualiza los datos, enviados desde el archivo "3_modificar.php" -->

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
	$clave = $_POST['clave'];
	$planestudios = $_POST['planestudios'];


	

	// Actualiza los datos
	$update = ("update materias set nombre='$nombre', clave='$clave', planestudios='$planestudios' where id='$id'");
	mysqli_query($conexion,$update);
	// Regresa al archivo "1_tabla.php"
	header("location:inicio_de_docentes.php");


?>