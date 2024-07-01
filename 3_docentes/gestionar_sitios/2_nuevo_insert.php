<!--Este archivo inserta los datos, los cuales fueron enviados desde el archivo "2_nuevo.html", en la base de datos-->

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
	$nombre = $_POST['txtNombre'];
	$link = $_POST['txtLink'];
	$desc = $_POST['txtDesc'];
	$img = $_FILES['txtImg'];


	/************************************************************ 
	| Recuperar y almacenar el id del usuario que inicio sesion |
	************************************************************/
	$id = $_SESSION['id'];


	/****************************************************************************** 
	| Formular la "consulta" para insertar las "varibles" en la tabla "sitiosweb" |
	******************************************************************************/
	$insert = "insert into sitiosweb values(0, '$link', '$nombre', '$desc', '$id')";


	/************************* 
	| Ejecutar la "consulta" |
	*************************/
	mysqli_query($conexion,$insert);
	

	/***************************************************** 
	| Verificar si el nuevo sitio web incluye una imagen |
	*****************************************************/
	if($img["name"] != ""){
		/* Si la variable "img" es diferente a vacio entonces si hay una imagen para
		   subir al servidor */
		subirImagen($img);
	}


	/********************************************************************** 
	| Despues de subir la imagen o no, se regresa al archivo "1_tabla.php"|
	**********************************************************************/
	header("location:1_tabla.php");


	function subirImagen($img){
		include("../conexion.php");

		$tiempo = getdate();
		// Variable que contiene el nombre de la imagen
		$nombre_de_la_imagen = $img["name"]; 
		// Al nombre de la imagen se le agrega la hora actual para que su nombre sea "unico"
		$nombre_de_la_imagen = strval($tiempo["year"]). strval($tiempo["mon"]). strval($tiempo["mday"]). strval($tiempo["hours"]). strval($tiempo["minutes"]). strval($tiempo["seconds"]). "_". $nombre_de_la_imagen; 

		// Subir al servidor
		move_uploaded_file($img["tmp_name"], "../../imagenes/".$nombre_de_la_imagen);

		// Recuperar el id del ultimo sitio web
		$consulta = "select id from sitiosweb order by id desc limit 1";
		$resultado = mysqli_query($conexion, $consulta);
		$registro = mysqli_fetch_array($resultado);
		$id = $registro["id"]; // A este id se relacinarán las imagenes

		//Insertar en la tabla imagenes la informacion de la imagen que esta relacionada al sitio web
		$insert = "insert into imagenes values(0, '$nombre_de_la_imagen',  'sitio', '$id')";
		mysqli_query($conexion,$insert);
	}
?>