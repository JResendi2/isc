<!--Este archivo solo contiene un formulario con la informacion de un registro seleccionado desde 
    el archivo "1_tabla.php", permite modificar esa informacino.-->

<?php



/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
 *************************************************************/
include("../../conexion.php");


/************************************************************************************************ 
	| Recuperar y almacena el id, del registro seleccionado, enviado desde el archivo "1_tabla.php" |
 ************************************************************************************************/
$idM = $_GET['idM'];
$idT = $_GET['idT'];


/****************************************************************************************************** 
	| Formular la "consulta" para obtener el registro de la tabla "sitiosweb" donde el id sea igual a $id |
 ******************************************************************************************************/
$consulta = "select titulo, link, descripcion, usuarios.usuario from temas inner join usuarios on temas.idusuario = usuarios.id where temas.id = '$idT'";


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
$link = $registro[1];
$descripcion = $registro[2];
$user = $registro[3];
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ISC oficial</title>
	<link rel="stylesheet" type="text/css" href="../../0_diseno/css/estilos.css">
</head>

<body>
	<header>
		<img src="../../0_diseno/img/logo1.png" height="55" style="margin-right: 150px; float: left;">
		<img src="../../0_diseno/img/logo2.png" height="55">
	</header>

	<nav class="navegacion">
		<a class="navegacion-home" href="../../inicio_de_docentes.php">
			<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
				<path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
			</svg>
			Inicio
		</a>

		<h3>Editar el tema de la materia</h3>
		<a class="navegacion-exit" href="../../logout.php">
			Cerrar sesion
		</a>
	</nav>

	<section>
		<form enctype="multipart/form-data" action="3_modificar_update.php" method="post">
			<div style="padding: 0 10px;">

				<table class="table-new">

					<?php
					/**************************************************************** 
					| Pegar los variables, obtenidas del registro, en el formulario |
					 ****************************************************************/

					echo '
					<tr>
						<td class="field">Titulo:</td>
						<td class="input"><input  type = text name = "titulo" size = 40 required value="' . $titulo . '"></td>
					</tr>
					<tr>
						<td class="field">Link:</td>
						<td class="input"><input type = text name = "link" size = 40 required value="' . $link . '"></td>
					</tr>
					<tr>
						<td>Descripcion:</td>
						<td class="input"><textarea rows="5" name = "descripcion" required>' . $descripcion . '</textarea></td>
					</tr>
					<tr>
						<td class="field">Creado por..</td>
						<td class="input"><input type = text name = "creado" value="' . $user . '"></td>
					</tr>
					
					<input type=hidden name=idT value = "' . $idT . '">
					<input type=hidden name=idM value = "' . $idM . '">'
					?>
					<tr>
						<td class="field">Nuevos archivos:</td>
						<td><input type=file name="txtFile[]" id="txtFile" multiple></td>
					</tr>
				</table> <br>
				<div class="div-btn-new">
            <input class="btn-new" type="submit" value="Guardar" />
          </div>
			</div>

		</form> <br><br>


		<!--FORMULARIO PARA VISUALIZAR LOS ARCHIVOS-->
		<form action="eliminarFile.php" method="post">
			<div style="padding: 0 10px;">

				<table>
					<tr>
						<th> Eliminar </th>
						<th> Archivo </th>
					</tr>

					<?php
					/**************************************************************************** 
						| Formular la "consulta" para obtener las archvios relacionadas al tema |
					 ****************************************************************************/
					$consulta = "select id, nombre from archivos where tipo = 'tema' and ids = '$idT'";


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
						$idI = $registro["id"];
						$nombre = $registro["nombre"];


						// PEGAR LOS "CAMPOS" EN UNA FILA DE LA TABLA.
						echo "
							<tr> 
								<td><input type=checkbox name=eliminar[] value=" . $idI . "></td> 
								<td>" . $nombre . "</td> 
							</tr>";
						/*	<input type=checkbox name=eliminar[] value=". $id.">
									input type=checkbox  -->	Agrega un checkbox por cada registro
									name=eliminar[]      --> 	"Crea un arreglo" llamado eliminar
									value=".$id."        -->	"Almacena en el arreglo" el id de cada registro, un
																id en cada espacio del arreglo.  
							*/
					}
					echo "
						<input type=hidden name=idT value = $idT>
						<input type=hidden name=idM value = $idM>";
					?>
				</table>
			</div>

			<input class="btn-delete" type=submit value="Eliminar archivos">
			<!-- Este boton abre el "archivo":  ->  "4_delete.php"
			     		 Envia el arrego "eliminar[]" hacia ese mismo "archivo""-->
		</form>
	</section>
</body>

</html>