<!--Este archivo inserta los datos, los cuales fueron enviados desde el archivo "2_nuevo.html", en la base de datos-->

<?php 

	/************************************* 
	| Verificar si alguien inicio sesion |
	*************************************/
	session_start();//Se inicia una sesion
	if(!isset($_SESSION['user'])){// Verefica si existe la variable 'user' en el servidor
		//Si no existe entonces no existe ninguna sesion activa por lo que regresa al login
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
	$nombre = $_POST['nombre'];
	$especialidad = $_POST['especialidad'];
	$descripcion = $_POST['descripcion'];


	/************************************************************ 
	| Recuperar y almacenar el id del usuario que inicio sesion |
	************************************************************/
	$id = $_SESSION['id'];


	/****************************************************************************** 
	| Formular la "consulta" para insertar las "varibles" en la tabla "profesores" |
	******************************************************************************/
	$insert = "insert into profesores values(0, '$nombre', '$especialidad', '$descripcion')";


	/************************* 
	| Ejecutar la "consulta" |
	*************************/
	mysqli_query($conexion,$insert);
	

	/********************************************************************** 
	| Despues de subir la imagen o no, se regresa al archivo "1_tabla.php"|
	**********************************************************************/
	header("location:1_tabla.php");

?>