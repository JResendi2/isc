<!--Este archivo solo contiene un formulario con la informacion de un registro seleccionado desde 
    el archivo "1_tabla.php", permite modificar esa informacion.-->

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
	$id = $_GET['id'];


	/****************************************************************************************************** 
	| Formular la "consulta" para obtener el registro de la tabla "avisos" donde el id sea igual a $id |
	******************************************************************************************************/
	$consulta = "select titulo, informacion, tipo_informacion, fecha_fin, usuarios.usuario from avisos inner join usuarios on avisos.idusuario = usuarios.id where avisos.id = '$id'";


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
	$titulo = $registro[0];
	$info = $registro[1];
	$tipo = $registro[2];
	$fecha = $registro[3];
	$user = $registro[4];
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
		<header>
			<img src="../../css/img/logo1.png" height="55" style="margin-right: 150px; float: left;">
			<img src="../../css/img/logo2.png" height="55">
		</header>

		<nav>
			<u1 class='lista' >
				<li class='menus'><a href='../../funciones/gestionar_docentes/1_tabla.php'><div>Docentes</div></a>  </li>
				<li class='menus'><a href='../../funciones/gestionar_materias/1_tabla.php'><div>Materias</div></a>  </li>
				<li class='menus'><a href='../../funciones/gestionar_semestres/1_tabla.php'><div>Semestres</div></a>  </li>
				<li class='menus'><a href='../../funciones/gestionar_sitios/1_tabla.php'><div>Sitios webs</div></a>  </li>
				<li class='menus'><a href='../../funciones/gestionar_avisos/1_tabla.php'><div>Avisos</div></a>  </li>
				<li class='menus'><a href='../../funciones/gestionar_usuarios/1_tabla.php'><div>Usuarios</div></a>  </li>
				<li class='menus'><a href='../../salir.php'><div>Salir</div></a>  </li>
			</u1>
		</nav>

		<section>

			<h2>Avisos - Modificar</h2>

			<form enctype="multipart/form-data" action = "3_modificar_update.php" method="post">
				<table>

					<?php 
					/**************************************************************** 
					| Pegar los variables, obtenidas del registro, sobre el formulario |
					****************************************************************/

					echo '
					<tr>
						<td>Titulo:</td>
						<td><input type = text name = "txtTitulo" size = 40 required value="'.$titulo.'"></td>
					</tr>
					<tr>
						<td>Información:</td>
						<td><textarea name = "txtInfo" required>'.$info.'</textarea></td>
					</tr>
					<tr>
						<td>Tipo de información:</td>';
						if($tipo == "noticia"){
							echo 
						'<td><input type = text name = "tipo" required value="Noticia"></td>';
						} else {
							echo 
						'<td><input type = text name = "tipo" required value="Recordatorio"></td>';
						}
						echo 
					'</tr>
					<tr>
						<td>Fecha de cierre:</td>
						<td><input type = text name = "fechaActual" value="'.$fecha.'"></td>
					</tr>
					<tr>
						<td>Cambiar la fecha:</td>
						<td><input type = date name = "fechaNueva"></td>
					</tr>';
						
					echo '
					<tr>
						<td>Creado por..</td>
						<td><input type = text name = "txtCreado" value="'.$user.'"></td>
					</tr>
					
					<input type=hidden name=id value = "'.$id.'">'
					?>
				</table> <br>

				<input type = submit value = "Guardar">
				<!--Este boton abre el archivo "3_modificar_update.php", y envia los datos del formulario hacia ese mismo archivo-->

				<input type = reset value = "Limpiar campos">
			</form>	<br><br>



			<!--TABLA PARA VISUALIZAR LAS IMAGENES-->
				<table>	
				<h4>Imagenes</h4>			
					<?php
						/***************************************************************************** 
						| Formular la "consulta" para obtener las imagenes relacionadas al sitio web |
						*****************************************************************************/
						$consulta = "select id, nombre from imagenes where tipo = 'aviso' and ids = '$id'";
						/*************************************************************** 
						| Ejecutar la "consulta" y almacenar el "registro" que devuelve|
						***************************************************************/
						$resultado_de_la_consulta = mysqli_query($conexion, $consulta);
						/*************************************** 
						| Mostrar los registros (imagenes) de la consulta |
						***************************************/
						while ($registro = mysqli_fetch_array($resultado_de_la_consulta)) { 
							$nombre = $registro["nombre"];
							echo"
							<tr>  
								<td><img width='600' id='imagen' src='../../../imagenes/". $nombre. "'></td> 
							</tr>"; 
						}
						?>
				</table>



			<!--TABLA PARA VISUALIZAR LOS ARCHIVOS-->
				<table>
				<h4>Archivos</h4>
					<?php
						/**************************************************************************** 
						| Formular la "consulta" para obtener las imagenes relacionadas al sitio web |
						****************************************************************************/
						$consulta = "select id, nombre from archivos where tipo = 'aviso' and ids = '$id'";
						/*************************************************************** 
						| Ejecutar la "consulta" y almacenar el "registro" que devuelve|
						***************************************************************/
						$resultado_de_la_consulta = mysqli_query($conexion, $consulta);
						/*************************************** 
						| Mostrar los registros de la consulta |
						***************************************/
						while ($registro = mysqli_fetch_array($resultado_de_la_consulta)) { 
							$nombre = $registro["nombre"];
							// PEGAR LOS "CAMPOS" EN UNA FILA DE LA TABLA.
							echo"
							<tr> 
								<td>". $nombre. "</td> 
							</tr>";							
						}
						?>
				</table>
		</section>
	</body>
</html>