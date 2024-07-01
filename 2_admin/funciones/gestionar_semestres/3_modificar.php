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
	$idS = $_GET['id'];


	/****************************************************************************************************** 
	| Formular la "consulta" para obtener el registro de la tabla "sitiosweb" donde el id sea igual a $id |
	******************************************************************************************************/
	$consulta = "select numero, periodo from semestres where id = '$idS'";


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
	$numero = $registro[0];
	$periodo = $registro[1];
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

			<h3 class="subtitulo-new">Modifica los datos del semestre</h3>


			<form enctype="multipart/form-data" action = "3_modificar_update.php" method="post">
			<div style="padding: 0 10px;">
				
				<table class="table-new">

					<?php 
					/**************************************************************** 
					| Pegar los variables, obtenidas del registro, en el formulario |
					****************************************************************/

					echo '
					<tr>
						<td>Numero:</td>
						<td><input type = text name = "numero" size = 40 required value="'.$numero.'"></td>
					</tr>
					<tr>
						<td>Periodo:</td>
						<td><input type = text name = "periodo" size = 40 required value="'.$periodo.'"></td>
					</tr>
					
					<input type=hidden name=id value = "'.$idS.'">'
					?>
				</table> <br>
			</div>

				<div class="div-btn-new">
					<input class="btn-new" type = submit value = "Guardar">
					<input class="btn-new" type = reset value = "Limpiar campos">
				</div>	
			</form>	<br>

			<h3 class="subtitulo-semestres">Materias del semestre</h3>
			<!--FORMULARIO PARA VISUALIZAR LAS MATERIAS DEL SEMESTRE-->
			<form action = "eliminarRelacion.php" method="post">
			<div style="padding: 0 10px;">
				<table>
					<tr>
						<th> Eliminar relación </th> 
						<th> Materias del semestre </th>	
						<th> Docente de la materia </th>	
					</tr>
				
					<?php
						/***************************************************************************** 
						| Formular la "consulta" para obtener las imagenes relacionadas al sitio web |
						*****************************************************************************/
						$consulta = "select materias.id, materias.nombre, profesores.nombre from materias inner join mat_sem_prof on materias.id = mat_sem_prof.idmateria inner join profesores on profesores.id = mat_sem_prof.idprofesor WHERE mat_sem_prof.idsemestre = $idS";


						/*************************************************************** 
						| Ejecutar la "consulta" y almacenar el "registro" que devuelve|
						***************************************************************/
						$resultado_de_la_consulta = mysqli_query($conexion, $consulta);
							/*
								mysqli_query()             -->  Ejecuta la consulta sql y devuelve un "resultado"
	   						    $resultado_de_la_consulta  -->  Almacena el "resultado"	
	   						 */


	   					$materias_del_semestre = "";


						/*************************************** 
						| Mostrar los registros de la consulta |
						***************************************/
						while ($registro = mysqli_fetch_array($resultado_de_la_consulta)) { 
								/*
									mysqli_fetch_array()  -->  "Obtiene" un registro del objeto
									$registro             -->  "Almacena" el registro en forma de un vector o arreglo

									y mientras existan registros...
								*/

							// COPIAR LOS "CAMPOS" DE CADA REGISTRO.
							$idM = $registro[0];
							$materia = $registro[1];
							$profesor = $registro[2];


							// PEGAR LOS "CAMPOS" EN UNA FILA DE LA TABLA.
							echo"
							<tr> 
								<td><input type=checkbox name=eliminar[] value=".$idM."></td> 
								<td>$materia</td> 
								<td>$profesor</td>
							</tr>";
							/*	<input type=checkbox name=eliminar[] value=". $id.">
									input type=checkbox  -->	Agrega un checkbox por cada registro
									name=eliminar[]      --> 	"Crea un arreglo" llamado eliminar
									value=".$id."        -->	"Almacena en el arreglo" el id de cada registro, un
																id en cada espacio del arreglo.  
							*/
							
						}
						echo"
						<input type=hidden name=id value = $idS>";
						?>
				</table>
					</div>

				<input type=submit class="btn-delete" value="Eliminar relación">
					<!-- Este boton abre el "archivo":  ->  "4_delete.php"
			     		 Envia el arrego "eliminar[]" hacia ese mismo "archivo""-->
			</form>	<br><br>



			<h3 class="subtitulo-semestres">Agrega nuevas materias al semestre</h3>
			<!--FORMULARIO PARA VISUALIZAR LAS MATERIAS QUE SE PUEDEN AGREGAR AL SEMESTRE-->
			<form action = "5_añadir_materias.php" method="post">
			<div style="padding: 0 10px;">
				
			<table>
					<tr>
						<th> Agregar </th> 
						<th> Materia </th>	
						<th> Elija al docente que imparte la materia </th>	
					</tr>
				
					<?php
						/************************************************ 
						| Buscar los docentes que imparten las materias |
						************************************************/
						$docentes = obtenerDocentes();



						/**************************************************************************** 
						| Formular la "consulta" para obtener las materias disponibles |
						****************************************************************************/
						$consulta = "select id, materias.nombre from materias left join mat_sem_prof on materias.id = mat_sem_prof.idmateria where mat_sem_prof.idsemestre is null";


						/*************************************************************** 
						| Ejecutar la "consulta" y almacenar el "registro" que devuelve|
						***************************************************************/
						$resultado_de_la_consulta = mysqli_query($conexion, $consulta);
							/*
								mysqli_query()             -->  Ejecuta la consulta sql y devuelve un "resultado"
	   						    $resultado_de_la_consulta  -->  Almacena el "resultado"	
	   						 */


						/*************************************** 
						| Mostrar los registros de la consulta |
						***************************************/
						while ($registro = mysqli_fetch_array($resultado_de_la_consulta)) { 
								/*
									mysqli_fetch_array()  -->  "Obtiene" un registro del objeto
									$registro             -->  "Almacena" el registro en forma de un vector o arreglo

									y mientras existan registros...
								*/

							// COPIAR LOS "CAMPOS" DE CADA REGISTRO.
							$idM = $registro["id"];
							$nombre = $registro["nombre"];
						

							// PEGAR LOS "CAMPOS" EN UNA FILA DE LA TABLA.
							echo"
							<tr> 
								<td><input type=checkbox name=añadirMaterias[] value=".$idM."></td> 
								<td>". $nombre. "</td> 
								<td>
									<select name = 'docente_$idM' required>
										$docentes
									</select>
								</td>  
							</tr>";
							/*	<input type=checkbox name=eliminar[] value=". $id.">
									input type=checkbox  -->	Agrega un checkbox por cada registro
									name=eliminar[]      --> 	"Crea un arreglo" llamado eliminar
									value=".$id."        -->	"Almacena en el arreglo" el id de cada registro, un
																id en cada espacio del arreglo.  
							*/
							
						}
						echo"
						<input type=hidden name=id value = $idS>";


						function obtenerDocentes(){
							include("../../conexion/conexion.php");
							/****************************************************************** 
							| Formular la "consulta" para obtener los nombres de los docentes |
							******************************************************************/
							$sql = "select id, nombre from profesores";
							$resultado_de_la_consulta = mysqli_query($conexion, $sql); // Ejecutar la consulta
							$docentes = "";
							/*************************************** 
							| Mostrar los registros de la consulta |
							***************************************/
							while ($registro = mysqli_fetch_array($resultado_de_la_consulta)){
								$docente = $registro['nombre'];
								$docentes = $docentes . "<option value = '". $registro['id']. "' >  $docente </option>";
							}
							return $docentes;
						}
						?>

						
				</table>

			</div>
				<input class="btn-add" type=submit value="Agregar">
					<!-- Este boton abre el "archivo":  ->  "4_delete.php"
			     		 Envia el arrego "eliminar[]" hacia ese mismo "archivo""-->
			</form>
		</section>
	</body>
</html>