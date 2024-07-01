<!--Este archivo muestra una tabla con todos los registros de la tabla "avisos"-->

<?php
	/************************************* 
	| Verificar si alguien inicio sesion |
	*************************************/
	session_start();//Se inicia una sesion
	if(!isset($_SESSION['user'])){// Verefica si existe la variable 'user' en el servidor
		//Si no existe entonces regresa al login
		header("location:../../login.php");
		exit;
	}
	

	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../../conexion/conexion.php");


	/************************************************************************* 
	| Formular la "consulta" para obtener todos los registros de la tabla "avisos" |
	*************************************************************************/
	$consultar = "select avisos.id, titulo, tipo_informacion, fecha_fin, usuario from avisos inner join usuarios on avisos.idusuario = usuarios.id"; 
	

	/*************************************************************** 
	| Ejecutar la consulta y almacenar los registros que devuelva|
	***************************************************************/
	$resultado_de_la_consulta = mysqli_query($conexion, $consultar); 
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
			<h2 class="subtitulo">Añade avisos para los estudiantes</h2>

			<form action=4_delete.php method=post>
				<div class="div-btn-new">
				<a href='2_nuevo.html'>
					<div class="btn-new">
						Nuevo Aviso
					</div>
				</a>
				</div>

				<div style="padding: 0 10px;">

				<table>
					<tr>
						<th> Eliminar </th> 
						<th> Titulo </th>	
						<th> Realizado por.. </th>	
						<th> Fecha de fin </th>	
						<th> Tipo </th>	
						<th> Modificar </th>
					</tr>


					<?php 

					/************************************ 
					| Mostrar los avisos de la consulta |
					************************************/

					while ($registro = mysqli_fetch_array($resultado_de_la_consulta)) { // Mientras existan registros...
							/*
								mysqli_fetch_array()  -->  "Obtiene" un registro del objeto $resultado_de_la_consulta
								$registro             -->  "Almacena" el registro en forma de un vector o arreglo

								y mientras existan registros...
							*/

						// COPIAR LOS "CAMPOS" DE CADA REGISTRO.
						$id = $registro[0];
						$titulo = $registro[1];
						$tipo = $registro[2];
						$fecha = $registro[3];
						$user = $registro[4];

						// PEGAR LOS "CAMPOS" EN UNA FILA DE LA TABLA DE LA PAGINA.
						echo"
						<tr> 
							<td><input type=checkbox name=eliminar[] id='".$registro['id']."' value=".$registro['id']." onclick='mover(this)'></td> 
							<td>". $titulo. "</td> 
							<td>". $user. "</td> 
							<td>". $fecha. "</td> 
							<td>". $tipo. "</td> 
							<td><a href='3_modificar.php?id=".$registro["id"]."'> Modificar</a> </td>
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
		<footer>
			<p>Ingenieria en Sistemas Computacionales</p>
		</footer>
	</body>
</html>