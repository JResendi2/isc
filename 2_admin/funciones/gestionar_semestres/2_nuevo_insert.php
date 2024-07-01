<!--Este archivo inserta los datos, los cuales fueron enviados desde el archivo "2_nuevo.html", en la base de datos-->

<?php 

	/************************************* 
	| Verificar si alguien inicio sesion |
	*************************************/
	session_start();//Se inicia una sesion
	if(!isset($_SESSION['user'])){// Verefica si existe la variable 'user' en el servidor
		//Si no existe entonces no existe ninguna sesion activa por lo que regresa al login
		header("location:../../login.php");
		exit;
	}


	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../../conexion/conexion.php");


	/****************************************************************** 
	| Recuperar los datos del formulario y almacenarlos en "varibles" |
	******************************************************************/
	$numero = $_POST['numero'];
	$periodo = $_POST['periodo'];


	/************************************************************ 
	| Recuperar y almacenar el id del usuario que inicio sesion |
	************************************************************/
	$id = $_SESSION['id'];


	/****************************************************************************** 
	| Formular la "consulta" para insertar las "varibles" en la tabla "sitiosweb" |
	******************************************************************************/
	$insert = "insert into semestres values(0, '$titulo', '$periodo')";


	/************************* 
	| Ejecutar la "consulta" |
	*************************/
	mysqli_query($conexion,$insert);


	/******************************************************************************* 
	| Despues de subir cualquier archivo, o no, se regresa al archivo "1_tabla.php"|
	*******************************************************************************/
	header("location:1_tabla.php");


?>