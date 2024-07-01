<!--Este archivo solo contiene un formulario con la informacion de un registro seleccionado desde 
    el archivo "1_tabla.php", permite modificar esa informacino.-->

<?php

	/************************************* 
	| Verificar si alguien inicio sesion |
	*************************************/
	session_start();//Se inicia una sesion
	if(!isset($_SESSION['user'])){// Verefica si existe la variable 'user' en el servidor
		//Si no existe entonce no existe ninguna sesion activa por lo que regresa al login
		header("location:../../login.php");
		exit;
	}


	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../../conexion/conexion.php");


	/************************************************************************************************ 
	| Recuperar y almacena el id, del registro seleccionado, enviado desde el archivo "1_tabla.php" |
	************************************************************************************************/
	$id = $_GET['idM'];


	/****************************************************************************************************** 
	| Formular la "consulta" para obtener el registro de la tabla "materias" donde el id sea igual a $id |
	******************************************************************************************************/
	$consulta = "select materias.nombre, clave, planestudios, profesores.nombre from materias left join mat_sem_prof on materias.id = mat_sem_prof.idmateria left join profesores on profesores.id = mat_sem_prof.idprofesor where materias.id = '$id'";


	/*************************************************************** 
	| Ejecutar la "consulta" y almacenar el "registro" que devuelve|
	***************************************************************/
	$resultado_de_la_consulta = mysqli_query($conexion, $consulta);
		/*
			mysqli_query()             -->  Ejecuta la consulta sql y devuelve un "resultado"
	        $resultado_de_la_consulta  -->  Almacena el "resultado"	
	    */


	/************************************************ 
	| Obtener el "registro" en forma de una arreglo |
	************************************************/
	$registro = mysqli_fetch_array($resultado_de_la_consulta);

	
	/********************************************** 
	| Copiar los campos del registro en variables |
	**********************************************/
	$nombre = $registro[0];
	$clave = $registro[1];
	$nombrep = $registro[3];
	$planestudios = $registro[2];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ISC oficial</title>
		<link rel="stylesheet" type="text/css" href="../../css/css/estilos.css">
	</head>
	
	<body>
	<nav>
		<u1 class='lista'>
			<li class='menus'><a href='../../funciones/gestionar_docentes/1_tabla.php'>
					<div>Docentes</div>
				</a> </li>
			<li class='menus'><a href='../../funciones/gestionar_materias/1_tabla.php'>
					<div>Materias</div>
				</a> </li>
			<li class='menus'><a href='../../funciones/gestionar_semestres/1_tabla.php'>
					<div>Semestres</div>
				</a> </li>
			<li class='menus'><a href='../../funciones/gestionar_sitios/1_tabla.php'>
					<div>Sitios webs</div>
				</a> </li>
			<li class='menus'><a href='../../funciones/gestionar_avisos/1_tabla.php'>
					<div>Avisos</div>
				</a> </li>
			<li class='menus'><a href='../../funciones/gestionar_usuarios/1_tabla.php'>
					<div>Usuarios</div>
				</a> </li>
			<li class='menus'><a href='../../logout.php'>

					<div>Salir</div>
				</a> </li>
			</u1>
			<img src="../../css/img/logo1.png" height="35">

	</nav>

		<section>

			<h2>Materias - Modificar</h2>

			<form enctype="multipart/form-data" action = "3_modificar_update.php" method="post">
				<table>

					<?php 
					/**************************************************************** 
					| Pegar los variables, obtenidas del registro, en el formulario |
					****************************************************************/

					echo '
					<tr>
						<td>Nombre:</td>
						<td><input type = text name = "nombre" size = 40 required value="'.$nombre.'"></td>
					</tr>
					<tr>
						<td>Clave:</td>
						<td><input type = text name = "clave" required value="'.$clave.'"></td>
					</tr>
					<tr>
						<td>Plan de estudios</td>
						<td><input type = text name = "planestudios" value="'.$planestudios.'"></td>
					</tr>
					
					<input type=hidden name=id value = "'.$id.'">'
					?>
					<tr>
						<td>Nuevo plan de estudios:</td>
						<td><input type = file name = "archivo" id="archivo"></td>
					</tr>
					<?php 
					echo '
					<tr>
						<td>Nombre del profesor que imparte la materia:</td>
						<td><input type = text name = "profesor" size = 40 value="'.$nombrep.'"></td>
					</tr>'
					?>
				</table> <br>

				<input type = submit value = "Guardar">
				<!--Este boton abre el archivo "3_modificar_update.php", y envia los datos del formulario hacia ese mismo archivo-->

				<input type = reset value = "Limpiar campos">
			</form>	<br><br>


				
		</section>
	</body>
</html>