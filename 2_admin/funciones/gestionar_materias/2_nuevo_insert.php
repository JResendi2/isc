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
	$nombre = $_POST['nombre'];
	$clave = $_POST['clave'];
	$plan = $_FILES['archivo'];
	$nombre_plan = "";


	/************************************************************ 
	| Recuperar y almacenar el id del usuario que inicio sesion |
	************************************************************/
	$id = $_SESSION['id'];


	/*********************************************
	| Verificar si se eligio un plan de estudios |
	*********************************************/
	if($plan["name"]!=""){// Si se seleccionaron archivos...
		//subir los archivos al servidor
		$nombre_plan = subirArchivo($plan);
	}


	/****************************************************************************** 
	| Formular la "consulta" para insertar las "varibles" en la tabla "materias" |
	******************************************************************************/
	$insert = "insert into materias values(0, '$nombre', '$clave', '$nombre_plan', '0')";


	/************************* 
	| Ejecutar la "consulta" |
	*************************/
	mysqli_query($conexion,$insert);

	
	/******************************************************************************* 
	| Se regresa al archivo "1_tabla.php"|
	*******************************************************************************/
	header("location:1_tabla.php");


	function subirArchivo($file){
		$tiempo = getdate();	
		$nombre_del_archivo = $file["name"]; 
		// Variable que contiene un nombre unico para el archivo
		$nombre_del_archivo = strval($tiempo["year"]). strval($tiempo["mon"]). strval($tiempo["mday"]). strval($tiempo["hours"]). strval($tiempo["minutes"]). strval($tiempo["seconds"]). "_". $nombre_del_archivo; 

		// Subir al servidor
		move_uploaded_file($file["tmp_name"], "../../../archivos/".$nombre_del_archivo);
		return $nombre_del_archivo;
	}
?>