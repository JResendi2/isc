<!--Este archivo elimina los datos, enviados desde el archivo "3_modificar.php" -->

<?php

	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../../conexion.php");


	/************************************************************************************ 
	| Recuperar y almacena el arreglo eliminar[] enviado desde el archivo "1_tabla.php" |
	************************************************************************************/
	$datosAEliminar = $_POST["eliminar"]; // Este arreglo contiene los id´s de los registros a eliminar
	$idM = $_POST["idM"]; // Esta variable contiene el id del sitio web

	/************************************************************ 
	| Eliminar los registros usando el arreglo datosAEliminar[] |
	************************************************************/
	if ($datosAEliminar != null) { 
		// Si el arreglo datosAEliminar[] no esta vacio, entonces...

			for ($i=0; $i < count($datosAEliminar); $i++) { // count() --> obtiene la longitud del arreglo
				//Para cada id que esta dentro del arreglo datosAEliminar[]...

				$id = $datosAEliminar[$i]; // Obtener el id

				// Formular la consuLta para eliminar la imagen relacionada al sitio web
				$sql = "delete from temas where id = $id";
				mysqli_query($conexion, $sql); // Ejecutar la consulta
				// Formular la consuLta para eliminar la imagen relacionada al sitio web
				$sql = "delete from archivos where ids = $id";
				mysqli_query($conexion, $sql); // Ejecutar la consulta
		}
	}
	mysqli_close($conexion); // cierra la conexion


	/*********************************** 
	| Regresar al archivo "1_tabla.php"|
	***********************************/
	header("location:../3_modificar.php?idM=$idM"); 
?>