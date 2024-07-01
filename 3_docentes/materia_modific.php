<!--Este archivo solo contiene un formulario con la informacion de un registro seleccionado desde 
    el archivo "1_tabla.php", permite modificar esa informacino.-->
	<?php
	session_start();//Se inicia una sesion
	if(!isset($_SESSION['user'])){// Verifica si existe la variable 'user' en el servidor
		//Si no existe entonce regresa al login
		header("location:../1_login/login.html");
		exit;
	}

	$id = $_SESSION['id']; /* Recupera el "usuario" que inicio sesion.
								  'user' es una variable almacenada en el servidor. */
?>
    
	<?php
	include("conexion.php");
	$id = $_GET['id']; // Recupera el 'id' del registro seleccionado desde el archivo "1_tabla.php"

	// Consulta los campos perteneciente al id recuperado anteriormente
	$consulta = "select nombre,clave,planestudios from materias  where materias.id = '$id'";

	$resultado_de_la_consulta = mysqli_query($conexion, $consulta);/* "mysqli_query" ejecuta la instruccion sql y el 
	                                                                   resultado se almacena en el "resultado_de_la_consulta" */
	$registro = mysqli_fetch_array($resultado_de_la_consulta); /* "mysqli_fetch_array" obtiene el primer registro 
																   del "resultado_de_la_consulta" */

	//Se recuperan todo los campos del "registro"
	$nombre = $registro['nombre'];
	$clave = $registro['clave'];
	$planestudios = $registro['planestudios'];
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ISC oficial</title>

	<link rel="stylesheet" type="text/css" href="0_diseno/css/estilos.css">


</head>
<body>

		<header>
				<img src="0_diseno/img/logo1.png" height="55" style="margin-right: 150px; float: left;">
				<img src="0_diseno/img/logo2.png" height="55">
		</header>

		<nav>
				
		</nav>

		<section>

			<h2>Plan de estudios</h2>

			<form action = "3_modificar_update.php" method="post">
			<table>

				<?php 
					/*En esta parte se agregan las variables, las que estan entre las lineas 16 y 20, en los 
					  elementos del formulario */

					echo '
					<tr>
						<td>nombre:</td>
						<td><input type = text name = "nombre" size = 40 required value="'.$nombre.'"></td>
					</tr>
					<tr>
						<td>clave:</td>
						<td><input type = text  name = "clave" size = 40 required value="'.$clave.'"></td>
					</tr>
					<tr>
						<td>planestudios:</td>
						<td><input type = text name = "planestudios" size = 40 required value="'.$planestudios.'"></td>
					</tr>
					
				<input type=hidden name=id value = "'.$id.'">'?>
				
			</table> <br><br>

			
			<input type = submit value = "Guardar">
			<!--Este boton abre el archivo "3_modificar_update.php", y envia los datos del formulario hacia ese mismo archivo-->

			<input type = reset value = "Limpiar campos">


		</form>	
		</section>


</body>

</html>