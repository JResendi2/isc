<!--Este archivo muestra una tabla con todos los registros de la tabla "materias"-->

<?php
	/************************************* 
	| Verificar si alguien inicio sesion |
	*************************************/
	session_start();//Se inicia una sesion
	if(!isset($_SESSION['user'])){// Verefica si existe la variable 'user' en el servidor
		//Si no existe entonces regresa al login
		header("location:../../login.html");
		exit;
	}
	

	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../../conexion/conexion.php");


	/***************************************************************************** 
	| Formular la "consulta" para obtener los registros de la tabla "usuarios" |
	*****************************************************************************/
	$consultar = "select id, usuario, nombre, numtelefono from usuarios where tipousuario = 'docente'"; 

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
			<h2 class="subtitulo">Registra a los usuarios</h2>

			<form action=4_delete.php method=post>
				<div class="div-btn-new">
				<a href='2_nuevo.php'>
					<div class="btn-new">
						Nuevo Usuario
					</div>
				</a>
				</div>

				<div style="padding: 0 10px;">
				<table>
					<tr>
						<th> Eliminar </th> 
						<th> Usuario </th>	
						<th> Nombre </th>	
						<th> Telefono </th>	
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
						$usuario = $registro["usuario"];
						$nombre = $registro["nombre"];
						$telefono = $registro["numtelefono"];
						//$user = $registro["usuario"];

						// PEGAR LOS "CAMPOS" EN UNA FILA DE LA TABLA DE LA PAGINA. <td>". $user. "</td>
						echo"
						<tr> 
							<td><input type=checkbox name=eliminar[] id='$id' value=".$id." onclick='mover(this)'></td> 
							<td>". $usuario. "</td> 
							<td>". $nombre. "</td> 
							<td>". $telefono. "</td> 
							<td><a href='3_modificar.php?id=$id'> Modificar</a> </td>
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
				}?>
			</table>
				</div>
			<input class="btn-delete" type=submit value=Eliminar >
				<!-- Este boton abre el "archivo "4_delete.php"
			     	 Envia el arrego "eliminar[]" hacia ese mismo "archivo""-->
			</form>		
		</section>
	</body>
</html>