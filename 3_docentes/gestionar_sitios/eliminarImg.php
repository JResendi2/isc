<!--Este archivo elimina los datos, enviados desde el archivo "3_modificar.php" -->

<?php

	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../conexion.php");


	/************************************************************************************ 
	| Recuperar y almacena el arreglo eliminar[] enviado desde el archivo "1_tabla.php" |
	************************************************************************************/
	$idI = $_POST["idI"]; // Esta variable contiene el id de la imagen
	$idS = $_POST["idS"]; // Esta variable contiene el id del sitio web

	/************************************************************ 
	| Eliminar los registros usando el arreglo datosAEliminar[] |
	************************************************************/
	if ($idI != "") { 
		// Formular la consuLta para eliminar la imagen que esta relacinada al sitio web
		$sql = "delete from imagenes where id = $idI";
		mysqli_query($conexion, $sql); // Ejecutar la consulta
	}
	mysqli_close($conexion); // cierra la conexion


	/*********************************** 
	| Regresar al archivo "1_tabla.php"|
	***********************************/
	header("location:3_modificar.php?id=$idS"); 
?>