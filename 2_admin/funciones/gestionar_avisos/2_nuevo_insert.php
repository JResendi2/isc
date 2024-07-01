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
	$titulo = $_POST['txtTitulo'];
	$info = $_POST['txtInfo'];
	$tipo = $_POST['tipo'];
	$fecha = $_POST['fecha'];


	/************************************************************ 
	| Recuperar y almacenar el id del usuario que inicio sesion |
	************************************************************/
	$id = $_SESSION['id'];


	/************************************* 
	| Identificar el tipo de informacion |
	*************************************/
	if($tipo == "Noticia"){
		$tipo = "noticia";
	} else {
		$tipo = "recordatorio";
		$fecha = $_POST['fecha'];
	}


	/****************************************************************************** 
	| Formular la "consulta" para insertar las "varibles" en la tabla "avisos" |
	******************************************************************************/
	$insert = "insert into avisos (id, titulo, informacion, tipo_informacion, idusuario, fecha_fin) values(0, '$titulo', '$info', '$tipo', '$id', '$fecha')";


	/************************* 
	| Ejecutar la "consulta" |
	*************************/
	mysqli_query($conexion,$insert);


	/************************************* 
	| Verificar si se eligieron imagenes |
	*************************************/
	if(file_exists($_FILES['txtImg']['tmp_name'][0])){// Si se seleccionaron imagenes...
		//subir las imagen al servidor
		subirImagen($_FILES['txtImg'], $tipo);
	}


	/************************************* 
	| Verificar si se eligieron archivos |
	*************************************/
	if(file_exists($_FILES['txtFile']['tmp_name'][0])){// Si se seleccionaron archivos...
		//subir los archivos al servidor
		subirArchivo($_FILES['txtFile'], $tipo);
	}

	
	/******************************************************************************* 
	| Despues de subir cualquier archivo o imagen, se regresa al archivo "1_tabla.php"|
	*******************************************************************************/
	header("location:1_tabla.php");

	
	function subirImagen($img, $tipo){
		include("../../conexion/conexion.php");

		// Recuperar el id del ultimo aviso
		$consulta = "select id from avisos order by id desc limit 1";
		$resultado = mysqli_query($conexion, $consulta);
		$registro = mysqli_fetch_array($resultado);
		$id = $registro["id"]; // A este id se relacinarán las imagenes

		$tiempo = getdate();

		foreach($img["tmp_name"] as $key => $tmp_name){	// Por cada archivo...	
			// Variable que contiene el nombre de la imagen
			$nombre_de_la_imagen = $img["name"][$key]; 
			// Al nombre de la imagen se le agrega la hora actual para que su nombre sea "unico"
			$nombre_de_la_imagen = strval($tiempo["year"]). strval($tiempo["mon"]). strval($tiempo["mday"]). strval($tiempo["hours"]). strval($tiempo["minutes"]). strval($tiempo["seconds"]). "_". $nombre_de_la_imagen; 

			// Subir al servidor
			move_uploaded_file($img["tmp_name"][$key], "../../../imagenes/".$nombre_de_la_imagen);

			//Se insertan los datos en la base de datos
			$insert = "insert into imagenes values(0, '$nombre_de_la_imagen', '$id', '$tipo')";
			mysqli_query($conexion,$insert);
		}
		
	}

	function subirArchivo($file, $tipo){
		include("../../conexion/conexion.php");

		// Recuperar el id del contenido
		$consulta = "select id from avisos order by id desc limit 1";
		$resultado = mysqli_query($conexion, $consulta); 
		$registro = mysqli_fetch_array($resultado);
		$id = $registro["id"]; // A este id se relacinarán los archivos
		
		$tiempo = getdate();

		foreach($file["tmp_name"] as $key => $tmp_name){ // Por cada archivo...
			// Variable que contiene el nombre del archivo
			$nombre_del_archivo = $file["name"][$key]; 
			// Variable que contiene un nombre unico para el archivo
			$nombre_del_archivo_unico = strval($tiempo["year"]). strval($tiempo["mon"]). strval($tiempo["mday"]). strval($tiempo["hours"]). strval($tiempo["minutes"]). strval($tiempo["seconds"]). "_". $nombre_del_archivo; 

			// Subir al servidor
			move_uploaded_file($file["tmp_name"][$key], "../../../archivos/".$nombre_del_archivo_unico);

			//Se insertan los datos en la base de datos
			$insert = "insert into archivos values(0, '$nombre_del_archivo', '$nombre_del_archivo_unico', '$id', '$tipo')";
			mysqli_query($conexion,$insert);
		}
	}
?>