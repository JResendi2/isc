<!--Este archivo actualiza los datos, enviados desde el archivo "3_modificar.php" -->

<?php 

	

	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../../conexion.php");



	/****************************************************************** 
	| Recuperar los datos del formulario y almacenarlos en "varibles" |
	******************************************************************/
	//$id = $_POST['id'];
	$titulo = $_POST['titulo'];
	$link = $_POST['link'];
	$descripcion = $_POST['descripcion'];
	$idT = $_POST['idT'];
	$idM = $_POST['idM'];


	/************************************************************ 
	| Recuperar y almacenar el id del usuario que inicio sesion |
	************************************************************/
	session_start();
	$iduser = $_SESSION['id'];


	/***************************************************** 
	| Formular la "consulta" para actualizar el registro |
	*****************************************************/
	$update = ("update temas set titulo='$titulo', link='$link', descripcion='$descripcion', idusuario='$iduser' where id='$idT'");


	/************************* 
	| Ejecutar la "consulta" |
	*************************/
	mysqli_query($conexion,$update);
	

	/******************************************** 
	| Verificar si se eligieron nuevos archivos |
	********************************************/
	if(file_exists($_FILES['txtFile']['tmp_name'][0])){// Si se seleccionaron nuevos archivos...
		//subir los archivos al servidor
		subirArchivo($_FILES['txtFile'],$idT);
	}

	/******************************************************************************* 
	| Despues de subir cualquier archivo, o no, se regresa al archivo "1_tabla.php"|
	*******************************************************************************/
	header("location:../3_modificar.php?idM=".$idM."&idT=".$idT);


	function subirArchivo($file,$idT){
		include("../../conexion.php");
		$tiempo = getdate();

		foreach($file["tmp_name"] as $key => $tmp_name){
			// Variable que contiene el nombre del archivo
			$nombre_del_archivo = $file["name"][$key]; 
			// Al nombre de la imagen se le agrega la hora actual para que su nombre sea "unico"
			$nombre_del_archivo_unico = strval($tiempo["year"]). strval($tiempo["mon"]). strval($tiempo["mday"]). strval($tiempo["hours"]). strval($tiempo["minutes"]). strval($tiempo["seconds"]). "_". $nombre_del_archivo; 

			// Subir al servidor
			move_uploaded_file($file["tmp_name"][$key], "../../../archivos/".$nombre_del_archivo_unico);

			//Se insertan los datos en la base de datos
			
			$insert = "insert into archivos (nombre, nombreunico, tipo, ids) values ('".$nombre_del_archivo."', '".$nombre_del_archivo_unico."', 'tema', '".$idT."')";

			//INSERT INTO `archivos` (`id`, `nombre`, `nombreunico`, `tipo`, `ids`) VALUES ('', '.exportcsv ', '.2022617165', '1', '2');
			echo $insert;
			mysqli_query($conexion,$insert);
		}
	}


?>