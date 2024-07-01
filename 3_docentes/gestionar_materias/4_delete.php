<!--Este archivo elimina los datos, enviados desde el archivo "1_tabla.php" -->

<?php

	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../conexion.php");		


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

			$id = $datosAEliminar[$i]; // Obtener el id la materia

			// PRIMERO: Eliminar los archivos de cada tema de la materia
			eliminarArchivos($id);

			// SEGUNDO: Eliminar los temas de la materia
			// Esto se hace automaticamente con el elimindo en cascada

			// TERCERO: Eliminar la materia
			// Formular la consuLta para eliminar la materia donde el id sea igual a la variable $id
			$sql = "delete from materias where id = '". $id. "'";
			mysqli_query($conexion, $sql); // Ejecutar la consulta
			
		}
	}
	mysqli_close($conexion); // cierra la conexion


	/*********************************** 
	| Regresar al archivo "1_tabla.php"|
	***********************************/
	header("location:1_tabla.php"); // regresa al archivo "1_tabla.php"


	function eliminarArchivos($id){
		include("../conexion.php");
		// Formular la consuLta para buscar los temas de la materia 
		$sql = "select id from temas where idmateria = $id"; 
		$temas = mysqli_query($conexion, $sql); // Ejecutar la consulta

		while($tema = mysqli_fetch_array($temas)){
			$idTema = $tema['id'];
			// Eliminar sus archivos
			// Formular la consuLta para eliminar los registro donde la id de la materia este como foranea
			$eliminarArchivos = "delete from archivos where ids = $idTema and tipo='tema'";
			mysqli_query($conexion, $eliminarArchivos); // Ejecutar la consulta
		}
	}
?>