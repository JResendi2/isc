<!--Este archivo elimina los datos, enviados desde el archivo "1_tabla.php" -->

<?php
	include("../conexion.php");		

	// Recupera el arreglo enviado desde el archivo "1_tabla.php".
	$datosAEliminar = $_POST["eliminar"]; // Este arreglo contiene los id´s a eliminar
					
		if ($datosAEliminar != null) { // Si el arreglo "datosAEliminar" no esta vacio...
			// se eliminan los registros

			for ($i=0; $i < count($datosAEliminar); $i++) { // count() --> obtiene la longitud del arreglo
				// Para cada id del arreglo "datosAEliminar", se elimina el registro perteneciente al id
				$sql = "delete from contenidos where id = '". $datosAEliminar[$i]. "'";
				mysqli_query($conexion, $sql);
			}
		}
		mysqli_close($conexion); // cierra la conexion
		header("location:1_tabla.php"); // regresa al archivo "1_tabla.php"

?>