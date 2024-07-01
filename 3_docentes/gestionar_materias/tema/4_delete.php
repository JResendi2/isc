<!--Este archivo elimina los datos, enviados desde el archivo "1_tabla.php" -->

<?php

	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../../conexion.php");		


	/************************************************************************************ 
	| Recuperar y almacena el arreglo eliminar[] enviado desde el archivo "1_tabla.php" |
	************************************************************************************/
	$datosAEliminar = $_POST["eliminar"]; // Este arreglo contiene los id´s a eliminar
				

	/************************************************************ 
	| Eliminar los registros usando el arreglo datosAEliminar[] |
	************************************************************/	
	if ($datosAEliminar != null) { 
		// Si el arreglo datosAEliminar[] no esta vacio, entonces...

		for ($i=0; $i < count($datosAEliminar); $i++) { // count() --> obtiene la longitud del arreglo
			//Para cada id que esta dentro del arreglo datosAEliminar[]...

			$id = $datosAEliminar[$i]; // Obtener el id

			$sql = "delete from archivos where ids = '". $id. "' and tipo='contenido'";
			mysqli_query($conexion, $sql); // Ejecutar la consulta
		}
	}
	mysqli_close($conexion); // cierra la conexion


	/*********************************** 
	| Regresar al archivo "1_tabla.php"|
	***********************************/
	//header("location:1_tabla.php"); // regresa al archivo "1_tabla.php"

?>