<!--Este archivo muestra una tabla con todos los registros de la tabla "contenidos"-->

<?php
session_start(); //Se inicia una sesion
if (!isset($_SESSION['user'])) { // Verefica si existe la variable 'user' en el servidor
	//Si no existe entonces no existe ninguna sesion activa por lo que regresa al login
	header("location:../../login/index.html");
	exit;
}



include("../conexion.php");

//Consultar todos los registros de la tabla "contenidos"
$consultar = "select contenidos.id, titulo, usuario from contenidos inner join usuarios on contenidos.idusuario = usuarios.id";
$resultado_de_la_consulta = mysqli_query($conexion, $consultar);/* "mysqli_query" ejecuta la instruccion sql y el 
	                                                               r    esultado se almacena en el "resultado_de_la_consulta" */

$total_de_registros = mysqli_num_rows($resultado_de_la_consulta); /* "mysqli_num_rows" obtiene el total de registros
																	      del "resultado_de_la_consulta" */
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

		<h3>Agrega más información para la carrera</h3>
		<a class="navegacion-exit" href="../logout.php">
			Cerrar sesion
		</a>
	</nav>

	<section>


		<form action=4_delete.php method=post>

			<div class="div-btn-new">
				<a href='2_nuevo.html'>
					<div class="btn-new">
						Agregar más contenido
					</div>
				</a>
			</div>



			<div style="padding: 0 10px;">
				<table>
					<tr>
						<th> Eliminar </th>
						<th> Titulo </th>
						<th> Realizado por.. </th>
						<th> Modificar </th>
					</tr>

					<?php
					// Codigo para insertar los registros del "resultado_de_la_consulta" a la tabla de la pagina.

					while ($registro = mysqli_fetch_array($resultado_de_la_consulta)) { // Mientras existan registros...

						// recuperar todos los campo de cada registro
						$id = $registro["id"];
						$titulo = $registro["titulo"];
						$user = $registro["usuario"];

						// insertar todos los campos de cada registro en la tabla de la pagina
						echo "
					<tr>
						<td><input type=checkbox name=eliminar[] value=" . $registro['id'] . "></td> 
						<td>" . $titulo . "</td> 
						<td>" . $user . "</td> 
						<td><a href='3_modificar.php?id=" . $registro["id"] . "'> Modificar</a> </td>
					</tr>";
						/*
						...<input type=checkbox name=eliminar[] value=". $registro['id'].">...
							input type=checkbox		-->		se agrega un checkbox a cada registro
							name=eliminar[]         --> 	se crea un arreglo que contiene el "id" de cada registro

						...<a href='3_modificar.php?id=".$registro["id"]."'> Modificar</a>...
															Se agrega un enlace para cada registro
															Este enlace abre el archivo "3_modificar.php"
					*/
					} ?>

				</table>
			</div>
			<input class="btn-delete" type=submit value=Eliminar>
			<!--Este boton abre el archivo "4_delete.php", tambien envia el arrego "eliminar[]" hacia ese mismo archivo"-->
		</form>
	</section>

	</div>

</body>

</html>