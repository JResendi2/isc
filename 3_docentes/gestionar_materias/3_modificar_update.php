<!--Este archivo actualiza los datos, enviados desde el archivo "3_modificar.php" -->

<?php 

	

	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../conexion.php");



	/****************************************************************** 
	| Recuperar los datos del formulario y almacenarlos en "varibles" |
	******************************************************************/
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$clave = $_POST['clave'];
	$planestudios = $_POST['planestudios'];
	$nuevoplan = $_FILES['archivo'];


	/************************************************************ 
	| Recuperar y almacenar el id del usuario que inicio sesion |
	************************************************************/
	session_start();
	
	$iduser = $_SESSION['id'];



	/******************************************** 
	| Verificar si se eligio nuevo plan |
	********************************************/
	if($nuevoplan["name"]!=""){// Si se seleccionaron archivos...
		//subir los archivos al servidor
		$planestudios = subirArchivo($nuevoplan);
	}


	/***************************************************** 
	| Formular la "consulta" para actualizar el registro |
	*****************************************************/
	$update = ("update materias set nombre='$nombre', clave='$clave', planestudios='$planestudios' where id='$id'");


	/************************* 
	| Ejecutar la "consulta" |
	*************************/
	mysqli_query($conexion,$update);


	/******************************************************************************* 
	| Despues de subir cualquier archivo, o no, se regresa al archivo "1_tabla.php"|
	*******************************************************************************/
	header("location:1_tabla.php");




	function subirArchivo($file){
		$tiempo = getdate();	
		$nombre_del_archivo = $file["name"]; 
		// Variable que contiene un nombre unico para el archivo
		$nombre_del_archivo = strval($tiempo["year"]). strval($tiempo["mon"]). strval($tiempo["mday"]). strval($tiempo["hours"]). strval($tiempo["minutes"]). strval($tiempo["seconds"]). "_". $nombre_del_archivo; 

		// Subir al servidor
		move_uploaded_file($file["tmp_name"], "../archivos/".$nombre_del_archivo);
		return $nombre_del_archivo;
	}


	


?>