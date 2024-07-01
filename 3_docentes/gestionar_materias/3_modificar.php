<!--Este archivo solo contiene un formulario con la informacion de un registro seleccionado desde 
    el archivo "1_tabla.php", permite modificar esa informacino.-->

<?php


/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
 *************************************************************/
include("../conexion.php");


/************************************************************************************************ 
	| Recuperar y almacena el id, del registro seleccionado, enviado desde el archivo "1_tabla.php" |
 ************************************************************************************************/
$id = $_GET['idM'];


/****************************************************************************************************** 
	| Formular la "consulta" para obtener el registro de la tabla "sitiosweb" donde el id sea igual a $id |
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
	<link rel="stylesheet" type="text/css" href="../0_diseno/css/estilos.css">
</head>

<body>
	<header>
		<img src="../0_diseno/img/logo1.png" height="55" style="margin-right: 150px; float: left;">
		<img src="../0_diseno/img/logo2.png" height="55">
	</header>

	<nav class="navegacion">
		<a class="navegacion-home" href="../inicio_de_docentes.php">
			<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
				<path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
			</svg>
			Inicio
		</a>

		<h3>Modifica la información de las materias</h3>
		<a class="navegacion-exit" href="../logout.php">
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
						<td class="field">Nombre:</td>
						<td class="input"><input type = text name = "nombre" size = 40 required value="' . $nombre . '"></td>
					</tr>
					<tr>
						<td class="field">Clave:</td>
						<td class="input"><input type = text name = "clave" required value="' . $clave . '"></td>
					</tr>
					
					
					<input type=hidden name=id value = "' . $id . '">'
					?>

					<?php
					echo '
					<tr>
						<td class="field">Profesor de la materia:</td>
						<td><input type = text name = "profesor" size = 40 value="' . $nombrep . '"></td>
					</tr>'
					?>
				</table> <br>

			</div>

		</form> <br><br>


		<form action="tema/eliminarTema.php" method="post">
			
			<div class="div-btn-new">
				<a href='2_nuevo.html'>
					<?php echo "<a href = 'tema/2_nuevo.php?id=" . $id . "'>" ?>
					<div class="btn-new">
						Nuevo tema para la materia
						</div>
						</a>
			</div>


			<div style="padding: 0 10px;">
				<table>
					<tr>
						<th> Eliminar </th>
						<th> Tema </th>
						<th> Link </th>
						<th> Modificar </th>
					</tr>

					<?php
					/***************************************************************************** 
						| Formular la "consulta" para obtener las imagenes relacionadas al sitio web |
					 *****************************************************************************/
					$consulta = "select id, titulo, link from temas where idmateria = '$id'";


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
						$idT = $registro["id"];
						$titulo = $registro["titulo"];
						$link = $registro["link"];


						// PEGAR LOS "CAMPOS" EN UNA FILA DE LA TABLA.
						echo "
							<tr> 
								<td><input type=checkbox name=eliminar[] value=" . $idT . "></td> 
								<td>" . $titulo . "</td> 
								<td>" . $link . "</td> 
								<td><a href='tema/3_modificar.php?idT=" . $idT . "&idM=" . $id . "'> Modificar</a> </td>
							</tr>";
						/*	<input type=checkbox name=eliminar[] value=". $id.">
									input type=checkbox  -->	Agrega un checkbox por cada registro
									name=eliminar[]      --> 	"Crea un arreglo" llamado eliminar
									value=".$id."        -->	"Almacena en el arreglo" el id de cada registro, un
																id en cada espacio del arreglo.  
							*/
						/*	<a href='3_modificar.php?id=".$registro["id"]."'> Modificar</a>
									Agrega un enlace para cada registro. 
									El enlace abre el "archivo":  -->  "3_modificar.php"
									?id=".$id."	    			  -->  Envia una variable, con el id del registro que 
																       se ha presionado, hacia el mismo "archivo". 
							*/
					}
					echo "
						<input type=hidden name=idM value = $id>";
					?>
				</table>
			</div>

			<input class="btn-delete" type=submit value="Eliminar">
			<!-- Este boton abre el "archivo":  ->  "4_delete.php"
			     		 Envia el arrego "eliminar[]" hacia ese mismo "archivo""-->
		</form> <br><br>

	</section>
</body>

</html>