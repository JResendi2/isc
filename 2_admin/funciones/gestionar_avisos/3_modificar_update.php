<!--Este archivo actualiza los datos, enviados desde el archivo "3_modificar.php" -->

<?php 
	/************************************* 
	| Verificar si alguien inicio sesion |
	*************************************/
	session_start();//Se inicia una sesion
	if(!isset($_SESSION['user'])){// Verefica si existe la variable 'user' en el servidor
		//Si no existe entonces regresa al login
		header("location:../../login.html");
		exit;
	}
	

	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../../conexion/conexion.php");



	/****************************************************************** 
	| Recuperar los datos del formulario y almacenarlos en "varibles" |
	******************************************************************/
	$id = $_POST['id'];
	$titulo = $_POST['txtTitulo'];
	$info = $_POST['txtInfo'];
	$tipo = $_POST['tipo'];
	$fecha = $_POST['fechaNueva'];



	/************************************************************ 
	| Recuperar y almacenar el id del usuario que inicio sesion |
	************************************************************/
	$iduser = $_SESSION['id'];



	/************************************* 
	| Identificar el tipo de informacion |
	*************************************/
	if($tipo == "Noticia"){
		$tipo = "noticia";
	} else {
		$tipo = "recordatorio";
		$fecha = $_POST['fechaActual'];
		$fechaN = $_POST['fechaNueva'];
		if($fechaN != ""){
			$fecha = $fechaN;
		}
	}

	echo $_POST['fechaNueva'];


	/***************************************************** 
	| Formular la "consulta" para actualizar el registro |
	*****************************************************/
	if($fecha != ""){
		$update = ("update avisos set titulo='$titulo', informacion='$info', tipo_informacion = '$tipo', idusuario='$iduser', fecha_fin = '$fecha' where id='$id'");
	} else {
		$update = ("update avisos set titulo='$titulo', informacion='$info', tipo_informacion = '$tipo', idusuario='$iduser' where id='$id'");
	}



	/************************* 
	| Ejecutar la "consulta" |
	*************************/
	mysqli_query($conexion,$update);
	


	/******************************************************************************* 
	| Se regresa al archivo "1_tabla.php"|
	*******************************************************************************/
	header("location:1_tabla.php");

?>