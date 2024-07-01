<!--Este archivo inserta los datos, los cuales fueron enviados desde el archivo "2_nuevo.html", en la base de datos-->

<?php 

	


	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../../conexion.php");


	/****************************************************************** 
	| Recuperar los datos del formulario y almacenarlos en "varibles" |
	******************************************************************/
	$titulo = $_POST['titulo'];
	$link = $_POST['link'];
	$descripcion = $_POST['descripcion'];
	$idM = $_POST['id'];


	/************************************************************ 
	| Recuperar y almacenar el id del usuario que inicio sesion |
	************************************************************/
	session_start();
	
	$idU = $_SESSION['id'];


	/****************************************************************************** 
	| Formular la "consulta" para insertar las "varibles" en la tabla "sitiosweb" |
	******************************************************************************/
	$insert = "insert into temas values(0, '$link', '$titulo', '$descripcion', '$idU', '$idM')";


	/************************* 
	| Ejecutar la "consulta" |
	*************************/
	mysqli_query($conexion,$insert);


	/************************************* 
	| Verificar si se eligieron archivos |
	*************************************/
	if(file_exists($_FILES['txtFile']['tmp_name'][0])){// Si se seleccionaron archivos...
		//subir los archivos al servidor
		subirArchivo($_FILES['txtFile']);
	}

	
	/******************************************************************************* 
	| Despues de subir cualquier archivo, o no, se regresa al archivo "1_tabla.php"|
	*******************************************************************************/
	header("location:../3_modificar.php?idM=".$idM."");

	

	function subirArchivo($file){
		include("../../conexion.php");
		// Recuperar el id del contenido
		$consulta = "select id from temas order by id desc limit 1";
		$resultado = mysqli_query($conexion, $consulta); 
		$registro = mysqli_fetch_array($resultado);
		$idT = $registro["id"]; // A este id se relacinarán los archivos
		
		$tiempo = getdate();

		foreach($file["tmp_name"] as $key => $tmp_name){ // Por cada archivo...
			// Variable que contiene el nombre del archivo
			$nombre_del_archivo = $file["name"][$key]; 
			// Variable que contiene un nombre unico para el archivo
			$nombre_del_archivo_unico = strval($tiempo["year"]). strval($tiempo["mon"]). strval($tiempo["mday"]). strval($tiempo["hours"]). strval($tiempo["minutes"]). strval($tiempo["seconds"]). "_". $nombre_del_archivo; 

			// Subir al servidor
			move_uploaded_file($file["tmp_name"][$key], "../../../archivos/".$nombre_del_archivo_unico);

			//Se insertan los datos en la base de datos
			$insert = "insert into archivos values(0, '$nombre_del_archivo', '$nombre_del_archivo_unico', '$idT', 'tema')";
			mysqli_query($conexion,$insert);
		}
	}
?>