<!--Este archivo actualiza los datos, enviados desde el archivo "3_modificar.php" -->

<?php 
	session_start();

	include("../conexion.php");

	// Recupera los datos del formulario
	$id = $_POST['id'];
	$titulo = $_POST['txtTitulo'];
	$info = $_POST['txtInfo'];
	$img = $_FILES['txtImg'];
	$img2 = $_POST['img2'];
	$iduser = $_SESSION['id'];
	$num_files = count($img['name']);


	if ($img["name"] != "") {
		if($img2 == ""){
			suvirImagen($img, $id, $num_files);
		} else {
			cambiarImagen($img);
		}
	}


	// Actualiza los datos
	$update = ("update contenidos set titulo='$titulo', informacion='$info', idusuario='$iduser' where id='$id'");
	mysqli_query($conexion,$update);
	// Regresa al archivo "1_tabla.php"
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
		$insert = "update imagenes set nombre = '$nombre_de_la_imagen' where tipo = 'contenido' and ids='".$GLOBALS['id']."'";
		mysqli_query($conexion,$insert);	
	}

	function suvirImagen($img, $id, $num_files){
		include("../conexion.php");
		$tiempo = getdate();


		$insert = "delete from imagenes where tipo = 'contenido' and ids='".$GLOBALS['id']."'";
		mysqli_query($conexion,$insert);


		
		for ($i = 0; $i < $num_files; $i++) {
			// Variable que contiene el nombre de la imagen
			$nombre_de_la_imagen = $img["name"][$i]; 
			// Al nombre de la imagen se le agrega la hora actual para que su nombre sea "unico"
			$nombre_de_la_imagen = strval($tiempo["year"]). strval($tiempo["mon"]). strval($tiempo["mday"]). strval($tiempo["hours"]). strval($tiempo["minutes"]). strval($tiempo["seconds"]). "_". $nombre_de_la_imagen; 

			// Subir al servidor
			move_uploaded_file($img["tmp_name"][$i], "../../imagenes/".$nombre_de_la_imagen);

			// Modificar la imagen
			$insert = "insert into imagenes values (0, '$nombre_de_la_imagen', '$id', 'contenido')";
			mysqli_query($conexion,$insert);	
		}



			
	
		
	}


?>