<!--Este archivo muestra una tabla con todos los registros de la tabla "materias"-->

<?php



/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
 *************************************************************/
include("../conexion.php");
session_start(); //Se inicia una sesion
$id = $_SESSION['id'];

/***************************************************************************** 
	| Formular la "consulta" para obtener los registros de la tabla "materias" |
 *****************************************************************************/
$consultar = "select * from materias inner join mat_sem_prof on mat_sem_prof.idmateria = materias.id inner join usuarios on usuarios.iddocente = mat_sem_prof.idprofesor where usuarios.id=$id";
//$consultar = "select materias.id, materias.nombre, clave, usuario from materias inner join usuarios on materias.idusuario = usuarios.id"; 



/*************************************************************** 
	| Ejecutar la "consulta" y almacenar los registros que devuelva|
 ***************************************************************/
$resultado_de_la_consulta = mysqli_query($conexion, $consultar);/* "mysqli_query" ejecuta la instruccion sql y el 
	    /*
			mysqli_query()             -->  Ejecuta la consulta sql y devuelve un "resultado"
	        $resultado_de_la_consulta  -->  Almacena el "resultado"	
	    */
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
		<form action=4_delete.php method=post>
			<div style="padding: 0 10px;">
			<table>
				<tr>
					<th> Nombre </th>
					<th> Clave </th>
					<th> Modificar </th>
				</tr>


				<?php

				/*************************************** 
					| Mostrar los registros de la consulta |
				 ***************************************/

				while ($registro = mysqli_fetch_array($resultado_de_la_consulta)) { // Mientras existan registros...
					/*
								mysqli_fetch_array()  -->  "Obtiene" un registro del objeto $resultado_de_la_consulta
								$registro             -->  "Almacena" el registro en forma de un vector o arreglo

								y mientras existan registros...
							*/

					// COPIAR LOS "CAMPOS" DE CADA REGISTRO.
					$id = $registro["id"];
					$titulo = $registro[1];
					$clave = $registro[2];
					//$user = $registro["usuario"];

					// PEGAR LOS "CAMPOS" EN UNA FILA DE LA TABLA DE LA PAGINA. <td>". $user. "</td>
					echo "
						<tr> 
							<td>" . $titulo . "</td> 
							<td>" . $clave . "</td> 
							
							<td><a href='3_modificar.php?idM=" . $registro[0] . "'> Modificar</a> </td>
						</tr>";
					/*	<input type=checkbox name=eliminar[] value=". $id.">
									input type=checkbox  -->	Agrega un checkbox por cada registro
									name=eliminar[]      --> 	"Crea un arreglo" llamado eliminar
									value=".$id."        -->	"Almacena en el arreglo" el id de cada   registro, un id en cada espacio del arreglo.  
							*/
					/*	<a href='3_modificar.php?id=".$registro["id"]."'> Modificar</a>
									Agrega un enlace para cada registro. 
									El enlace abre el "archivo":  -->  "3_modificar.php"
									?id=".$id."	    			  -->  Envia una variable, con el id del registro que 
																       se ha presionado, hacia el mismo "archivo". 
							*/
				} ?>
			</table>
			</div>
		</form>
	</section>
</body>

</html>