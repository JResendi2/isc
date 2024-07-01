<!--Este archivo actualiza los datos, enviados desde el archivo "3_modificar.php" -->

<?php 
	/************************************* 
	| Verificar si alguien inicio sesion |
	*************************************/
	session_start();//Se inicia una sesion
	if(!isset($_SESSION['user'])){// Verefica si existe la variable 'user' en el servidor
		//Si no existe entonces regresa al login
		header("location:../../../login/index.html");
		exit;
	}
	

	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../../conexion/conexion.php");


	/****************************************************************** 
	| Recuperar los datos del formulario y almacenarlos en "varibles" |
	******************************************************************/
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$especialidad = $_POST['especialidad'];
	$descripcion = $_POST['descripcion'];


	/***************************************************** 
	| Formular la "consulta" para actualizar el registro |
	*****************************************************/
	$update = ("update profesores set nombre='$nombre', especialidad='$especialidad', descripcion='$descripcion' where id='$id'");


	/************************* 
	| Ejecutar la "consulta" |
	*************************/
	mysqli_query($conexion,$update);


	/******************************************************************************* 
	| Despues de subir cualquier archivo, o no, se regresa al archivo "1_tabla.php"|
	*******************************************************************************/
	header("location:1_tabla.php");


?>