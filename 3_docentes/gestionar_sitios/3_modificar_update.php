<!--Este archivo actualiza los datos, enviados desde el archivo "3_modificar.php" -->

<?php 
	/************************************* 
	| Verificar si alguien inicio sesion |
	*************************************/
	session_start();//Se inicia una sesion

	

	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../conexion.php");


	/****************************************************************** 
	| Recuperar los datos del formulario y almacenarlos en "varibles" |
	******************************************************************/
	$id = $_POST['id'];
	$nombre = $_POST['txtNombre'];
	$link = $_POST['txtLink'];
	$desc = $_POST['txtDesc'];
	$img = $_FILES['txtImg'];


	/************************************************************ 
	| Recuperar y almacenar el id del usuario que inicio sesion |
	************************************************************/
	$iduser = $_SESSION['id'];


	/***************************************************** 
	| Formular la "consulta" para actualizar el registro |
	*****************************************************/
	$update = ("update sitiosweb set link='$link', nombre='$nombre', descripcion='$desc', idusuario='$iduser' where id='$id'");
	echo $update;

	/************************* 
	| Ejecutar la "consulta" |
	*************************/
	mysqli_query($conexion,$update);


	/************************************* 
	| Verificar si se eligio otra imagen |
	*************************************/
	if($img["name"] != ""){
		/* Si la variable "img" es diferente a vacio entonces si hay una imagen para
		   subir al servidor */
		cambiarImagen($img);
	}


	/******************************************************************************* 
	| Despues de subir cualquier archivo, o no, se regresa al archivo "1_tabla.php"|
	*******************************************************************************/
	header("location:1_tabla.php");


	function cambiarImagen($img){
		include("../conexion.php");
		$tiempo = getdate();
	
		// Variable que contiene el nombre de la imagen
		$nombre_de_la_imagen = $img["name"]; 
		// Al nombre de la imagen se le agrega la hora actual para que su nombre sea "unico"
		$nombre_de_la_imagen = strval($tiempo["year"]). strval($tiempo["mon"]). strval($tiempo["mday"]). strval($tiempo["hours"]). strval($tiempo["minutes"]). strval($tiempo["seconds"]). "_". $nombre_de_la_imagen; 

		// Subir al servidor
		move_uploaded_file($img["tmp_name"], "../../imagenes/".$nombre_de_la_imagen);

		// Modificar la imagen
		$insert = "update imagenes set nombre = '$nombre_de_la_imagen' where tipo = 'sitio' and ids='".$GLOBALS['id']."'";
		mysqli_query($conexion,$insert);	
	}
?>