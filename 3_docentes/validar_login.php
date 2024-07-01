<!--Este archivo valida los datos enviados desde el archivo "login.html".
	De acuerdo a los datos, se abre una pagina u otra. -->

	<?php
	/*session_start();//Se inicia una sesion
	if(!isset($_SESSION['user'])){// Verifica si existe la variable 'user' en el servidor
		//Si no existe entonce regresa al login
		header("location:login.html");
		exit;
	}

	$id = $_SESSION['id'];*/ /* Recupera el "usuario" que inicio sesion.
								  'user' es una variable almacenada en el servidor. */
?>

<?php
	include("conexion.php");

	//Recuperar los datos del formulario.
	$usuario = $_POST['txtUser']; 
	$contra = $_POST ["txtContra"];


	// Consulta donde los campos "usuario" y "contraseña" sean igual a los datos enviados desde el formulario.
	$sql = "select tipousuario, id from usuarios where usuario = '$usuario' and contraseña = '$contra' and tipousuario = 'docente'"; 

	$resultado_de_la_consulta = mysqli_query($conexion, $sql); /* "mysqli_query" ejecuta la instruccion sql y el 
	                                                               resultado se almacena en el "resultado_de_la_consulta" */

	$total_de_registros = mysqli_num_rows($resultado_de_la_consulta); /* "mysqli_num_rows" obtiene el total de registros
																	  del "resultado_de_la_consulta" */


	if ($total_de_registros == 0) { // Si el "total_de_registros" es igual a 0...
		// los datos enviados desde el formulario "son incorectos".	

		echo "<script> alert('El usuario y/o la contraseña son incorrectos'); </script>"; 
		echo "<meta http-equiv=\"refresh\" content=\"0;url=login.html\"/> "; // Regresamos al login


	} else { // Si el "total_de_registros" no es 0...
		// los datos enviados desde el formulario "son corectos". 	


		$registro = mysqli_fetch_array($resultado_de_la_consulta); /* "mysqli_fetch_array" obtiene el primer registro 
																   del "resultado_de_la_consulta" */
		session_start(); // Se inicia una sesion
		// Se crean las variables 'user' y 'id' dentro del servidor
		$_SESSION['user'] = $usuario; // "usuario" es la variable de la linea 5
		$_SESSION['id'] = $registro['id']; // "registro['id']" es un campo del "registro"


		$tipo_de_usuario = $registro['tipousuario']; // // "registro['tipousuario']" es un campo del "registro"

		// De acuerdo al tipo de usuario, se abre a una pagina u otra.
		if($tipo_de_usuario == "admin"){ 
			header("location:inicio_de_admins.php"); // Pagina del usuario admin
		} else if($tipo_de_usuario == "docente"){
			header("location:inicio_de_docentes.php"); // Pagina del usuario docente
		}


	}
?>